<?php
/*
  For testing, run development server via CLI:
  ~$ php -S localhost:port
*/
require '../config.php';
require '../common/request.php';
require '../common/db.php';
global $CONFIG, $UI_PARAMS;


function response($res) {
    header('Content-type: application/json');
    echo json_encode($res, JSON_UNESCAPED_UNICODE);
    exit;
}

function compare_score($a, $b) {
    return $a['distance'] <= $b['distance'] ? -1 : 1;
}

function sorting_methods($feat_query, $feature_lo, $feature_hi) {
    $num_feats = count($feat_query);
    $num_methods = count($feature_lo);
    $selected = array_fill(0, $num_feats, 0);
    for ($i = 0; $i < $num_feats; $i++) {
        if ($feat_query[$i] > 0) {
            $selected[$i] = 1;
        }
    }

    // Compute the distance and return a `$respect` Flag in case the query is within distance bounds.
    // Flag is 1 if the query for a feature is within the method range, or 0 otherwise.
    // Flag is a table which can help to trace back which feature is not respected,
    // but it may be useless if we present the range while describing the method.
    // When the query respect the method range, its distance is 0.
    $respect = array();
    $num_viols = array_fill(0, $num_methods, 0);
    $distances = array_fill(0, $num_methods, 0);
    $scores = array_fill(0, $num_methods, 0);
    $results = array();
    for ($nMeth = 0; $nMeth < $num_methods; $nMeth++) {
        // Filling `$respect` with `1`s so that if the feature is not selected,
        // the bounds are automatically respected.
        // Hence we only update the table in case the feature is selected.
        $respect[$nMeth] = array_fill(0, $num_feats, 1);
        // Avoid performing the sum on array by employing auxiliary variable
        // and then storing the sum in the array.
        $dist = 0;
        $viol = 0;
        for ($nFeat = 0; $nFeat < $num_feats ; $nFeat++) {
            if ($selected[$nFeat] != 1) continue;

            if ($feat_query[$nFeat] >= $feature_lo[$nMeth][$nFeat] &&
                $feat_query[$nFeat] <= $feature_hi[$nMeth][$nFeat]) {
                $respect[$nMeth][$nFeat] = 1;
            } else {
                $viol = $viol + 1;
                $respect[$nMeth][$nFeat] = 0;
                // DISTANCE COMPUTATION
                // The distance between the query X and the lower bound L is `L - X`.
                // The distance between the query X and the higher bound H is `X - H`.
                $distL = $feature_lo[$nMeth][$nFeat] - $feat_query[$nFeat];
                $distH = $feat_query[$nFeat] - $feature_hi[$nMeth][$nFeat];
                // Since in this case at least one bound is not respected
                // (one of them is positive while the other is negative),
                // we just need to keep the positive value so `dist = max(L-X, X-H)`.
                // The maximum distance is `5 - 1 = 4`, so normalized each distance by 4
                // in order to obtain a distance with every feature between 0 and 1.
                $distLH = max($distL, $distH)/4;
                // If the feature is not selected we set its distance to 0.
                $dist = $dist + ($distLH * $distLH);
            }
        }
        // Normalize distance between 0 and 1.
        $distances[$nMeth] = sqrt($dist/$num_feats);
        $num_viols[$nMeth] = $viol;
        $scores[$nMeth] = sqrt($dist) + $viol;
        $results[$nMeth] = array(
            'distance' => $scores[$nMeth],
            'score' => 1 - $distances[$nMeth],
            'mismatches' => $num_viols[$nMeth],
        );
    }
    // Sorting method: lower score is better.
    asort($scores);
    for ($nMeth = 0; $nMeth < $num_methods; $nMeth++) {
        $scores[$nMeth] = 1 - fmod($scores[$nMeth], 1);
    }
    uasort($results, 'compare_score');
    return $results;
}


// Endpoints setup.
$endpoint = filter_var($_GET['action'], FILTER_SANITIZE_STRING);

switch ($endpoint) {
case 'update':
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    if (!$id) response(array('error' => 'No ID provided.'));

    if (empty($_POST)) response(array('error' => 'No data provided.'));

    $res = DB::update($id, $_POST);
    response(array('error' => $res === NULL, 'result' => $res));

    break;

case 'delete':
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    if (!$id) response(array('error' => 'No ID provided.'));

    $res = DB::delete($id);
    response(array('error' => $res === NULL, 'result' => $res));

    break;

case 'insert':
    if (empty($_POST)) response(array('error' => 'No data provided.'));

    $res = DB::insert($_POST);
    response(array('error' => $res === NULL, 'result' => $res));

    break;

case 'getone':
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    if (!$id) response(array('error' => 'No ID provided.'));

    $res = DB::getOne($id);
    response(array('error' => $res === NULL, 'result' => $res));

    break;

case 'getall':
    $res = DB::getAll();
    response(array('error' => $res === NULL, 'result' => $res));

    break;

case 'rank':
default:

    if (!empty($_POST)) {
        $user_params = $_POST['params'];

        // Easter egg, or a "surprise me" feature.
        if (isset($_POST['random'])) {
            foreach ($UI_PARAMS as $name => $value) {
                $user_params[$name] = rand(1, 5);
            }
        }

        // Use neutral scores if user resets the form.
        if (isset($_POST['reset'])) {
            foreach ($UI_PARAMS as $name => $value) {
                $user_params[$name] = 3;
            }
        }

        // Parse params, to indicate the search vector dimensions.
        foreach ($UI_PARAMS as $name => $value) {
            if (isset($user_params[$name])) {
                $user_params[$name] = intval($user_params[$name]);
            } else {
                // Use a number outside the 1-5 range to ignore disabled params.
                // For convenience, let's use the 0.
                $user_params[$name] = 0;
            }
        }
    } else {
        $user_params = $UI_PARAMS;
    }

    list($database, $feature_lo, $feature_hi) = DB::rank();
    // Gather selected weights for doing the search.
    $feature_query = array_values($user_params);
    $sorted_methods = sorting_methods($feature_query, $feature_lo, $feature_hi);

    // At this point everything was successful.
    response(array(
        'result' => array(
            'database' => $database,
            'ranking' => $sorted_methods,
            'params' => $user_params,
        ),
        'error' => empty($database),
    ));

    break;
}
