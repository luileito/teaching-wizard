<?php
function parse_tsv($db_filename, $sep="\t") {
    // For the records, these are the columns we need from the Excel file:
    // - method name
    // - group_size
    // - student_workload
    // - teacher_workload
    // - student_experience
    // - teacher_experience
    // - student_interaction
    // - description
    // - strenghs (pros)
    // - challenges (cons)
    $database_raw = file($db_filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (!$database_raw) {
        $msg = sprintf('File "%s" not found', $db_filename);
        throw new Exception($msg);
    }

    // Allocate structs.
    $database_clean = array();
    $feature_lo = array();
    $feature_hi = array();

    // Indices (zero-based) of the columns in the Excel sheet with the scores of each teaching method.
    $column_ids_with_scores = array(1, 2, 3, 4, 5, 6);

    // Parse Excel file.
    foreach ($database_raw as $row_num => $entry) {
        // Skip header.
        if ($row_num === 0) {
            continue;
        }

        // By default we use tab-separated values (TSV) to split columns by this token.
        // But any other standard token is also possible.
        $columns = explode($sep, $entry);
        $row_idx = $row_num - 1;

        // Parse column values.
        foreach ($columns as $col_idx => $value) {
            $value = trim($value);

            if (!in_array($col_idx, $column_ids_with_scores)) {
                $database_clean[$row_idx][$col_idx] = $value;
                continue;
            }

            if (!empty($value)) {
                // Some scores have ranges, denoted with a dash.
                if (strpos($value, '-') !== FALSE) {
                    list($lo, $hi) = explode('-', $value);
                    $lo = floatval($lo);
                    $hi = floatval($hi);
                } else {
                    $lo = $hi = floatval($value);
                }

                // Notice that we use $col_idx to store each feature,
                // so let's be consistent to avoid PHP Notice (Undefined offset).
                $feature_lo[$row_idx][$col_idx - 1] = $lo;
                $feature_hi[$row_idx][$col_idx - 1] = $hi;
            } else {
                // Remove rows with no scores.
                unset($database_clean[$row_idx], $feature_lo[$row_idx], $feature_hi[$row_idx]);
                break;
            }
        }
    }

    // Remove useless indices from DB array and add entry ID.
    $database = array();
    foreach ($database_clean as $row_idx => $entry) {
        $id = $row_idx + 1;
        $ar = array_values($entry);
        array_unshift($ar, $id);
        $database[] = $ar;
    }

    return array($database, $feature_lo, $feature_hi);
}
