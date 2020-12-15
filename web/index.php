<?php
/*
  For testing, run development server via CLI:
  ~$ php -S localhost:port
*/
require '../config.php';
require '../common/request.php';
global $CONFIG;

require '../common/identicon/Identicon.php';
require '../common/identicon/Generator/BaseGenerator.php';
require '../common/identicon/Generator/GeneratorInterface.php';
require '../common/identicon/Generator/SvgGenerator.php';

$fetch_all = do_request($CONFIG->API_SERVER, $_POST);
if ($fetch_all->error !== FALSE) {
    // FIXME: Display a fully-fledge web page instead of this sentence.
    die('API server not working. Please try again later.');
}

if (!empty($fetch_all->result->params)) {
    $params = (array) $fetch_all->result->params;
}

// Flag to deal with previous form submissions.
$prev_submission = !empty($_POST) && !isset($_POST['reset']);
?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <script type="text/javascript" src="js/jquery-2.0.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/cookies.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/feedback.css" />
    <script type="text/javascript" src="js/feedback.js"></script>

    <script>
    $(function() {

        // Initialize tooltips.
        $('[data-toggle="tooltip"]').tooltip();

        function addStar(el) {
            $(el).removeClass('fa-star-o').addClass('fa-star').attr('title', 'Mark as favorite');
        }

        function removeStar(el) {
            $(el).removeClass('fa-star').addClass('fa-star-o').attr('title', 'Unmark as favorite');
        }

        // "Mark as favorite" behavior.
        $('.method .title .fa')
        .css('cursor', 'pointer')
        .on('click', function(ev) {
            var methodId = $(this).parent().attr('id');
            var selected = !!Cookies.get(methodId);
            if (selected) {
                Cookies.remove(methodId);
                removeStar(this);
            } else {
                Cookies.set(methodId, 1);
                addStar(this);
            }
        })
        .each(function(index, el) {
            // Init stars.
            var methodId = $(this).parent().attr('id');
            var selected = !!Cookies.get(methodId);
            if (selected) addStar(this);
        });

        // TODO: Agree on these bins.
        var groupSize = {
            1: '5-20 students',
            2: '25-40 students',
            3: '45-60 students',
            4: '65-90 students',
            5: '100+ students',
        };

        $('input#group_size')
        .on('input', function(ev) {
            var val = groupSize[ev.target.value];
            this.$sliderElement = $(this).parent().find('.slider-value');
            this.$sliderElement.css({ opacity: 1 }).text(val);
        })
        .on('change', function(ev) {
            this.$sliderElement.delay(1000).animate({ opacity: 0 }, function(e) {
                $(this).empty().css({ opacity: 1 });
            });
        });

        $('input[type=checkbox]')
        .on('click', function(ev) {
            // Reset status of parent container to begin with.
            var $row = $(this).parents('.slider-group').removeClass('inactive');
            // Then update status.
            var isChecked = $(this).is(':checked');
            if (!isChecked) $row.addClass('inactive');
            // Also update slider status and label text.
            var statusLabel = isChecked ? 'enabled' : 'disabled';
            $row.find('input[type=range]').attr('disabled', !isChecked).find('.slider-status').text(statusLabel);
        });

        <?php if ($prev_submission): ?>

        var $methodEntries = $('.method');
        var numSuggestions = 3;
        var $hiddenMethods = $methodEntries.slice(numSuggestions).hide();
        var $paginationBtn = $('#loadmore');
        if (!$methodEntries.length) {
            $paginationBtn.html('<span class="text-muted">Please select your filtering options.</span>');
        } else {
            $paginationBtn.find('input').on('click', function(ev) {
                // Load one more suggestion.
                var $moreMethods = $('.method:hidden').slice(0, 1).show('fast');
                // Hide button when all suggestions are shown.
                if ($('.method:hidden').length === 0) {
                    $(this).parent().html('<span class="text-muted">No more results found.</span>');
                }
            });
        }

        <?php endif; ?>

    });
    </script>
  </head>
  <body>

    <div class="container-fluid global">

      <h2>The Teaching Wizard</h2>

      <div class="card">
        <div class="card-header">Filtering categories</div>
        <div class="card-body">

          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

          <?php
            function slider_group($title, $param_name, $param_value, $min_label, $max_label, $explanation) { // --- BEGIN slider fn ---
              $disabled = $param_value === 0;
          ?>
            <div class="row slider-group <?php if ($disabled) echo 'inactive'; ?>">
              <label class="col-sm-4 slider-title" for="<?php echo $param_name; ?>">
                <?php echo $title; ?>
                <span class="fa fa-question-circle-o"
                  data-toggle="tooltip" data-placement="top"
                  title="<?php echo $explanation; ?>"></span>
              </label>
              <span class="col-sm-1 slider-end text-center"><?php echo $min_label; ?></span>
              <span class="col-sm-2 slider-range-wrap">
                <span class="slider-value text-center"></span>
                <input type="range" name="params[<?php echo $param_name; ?>]" min="1" max="5" id="<?php echo $param_name; ?>"
                  <?php if ($disabled) echo 'disabled value="3"'; else echo 'value="'.$param_value.'"'; ?>
                  />
              </span>
              <span class="col-sm-1 slider-end text-center"><?php echo $max_label; ?></span>
              <div class="col-sm-4 slider-checker">
                <label>
                  <input type="checkbox"
                    <?php if (!$disabled) echo 'checked'; ?>
                    />
                  <span class="slider-status">enabled</span>
                </label>
              </div>
            </div>
          <?php } // --- END slider fn --- ?>

          <?php
          slider_group('Group size', 'group_size', $params['group_size'],
            '<a title="1-20 students">small</a>', '<a title="100+ students">large</a>',
            'How many students do you have in your course?');
          slider_group('Teacher experience', 'teacher_experience', $params['teacher_experience'],
            'low', 'high', 'Have you been teaching for many years and want to try new teaching methods?');
          slider_group('Student experience', 'student_experience', $params['student_experience'],
            'low', 'high', 'Do you assume some previous background for your course?');
          slider_group('Student workload', 'student_workload', $params['student_workload'],
            'low', 'high', 'How much effort should your students put in your course?');
          slider_group('Teacher workload', 'teacher_workload', $params['teacher_workload'],
            'low', 'high', 'How much effort are you willing to invest in your teaching?');
          slider_group('Student interaction', 'student_interaction', $params['student_interaction'],
            'low', 'high', 'How much interaction would you expect in your course?');
          ?>

          <div class="mt-4 form-buttons text-center">
            <input class="col-sm-2 btn btn-primary" type="submit" />
            <input class="col-sm-2 btn btn-secondary" type="submit" name="reset" value="Reset" />
            <input class="col-sm-2 btn btn-outline-info" type="submit" name="random" value="Surprise me!" />
          </div>

          </form>

        </div>
      </div>

      <h4 class="text-center text-muted">
        <?php echo sprintf('%d teaching methods currently available!', count($fetch_all->result->database)); ?>
      </h4>

      <!--
      <?php if ($prev_submission): ?>
        <p class="text-center text-muted">
        <?php if (!empty($fetch_all->result->database)): ?>
            <?php echo sprintf('There are %d teaching methods matching your criteria.', count($fetch_all->result->database)); ?>
        <?php else: ?>
            That's a creative presets combination &#128521;
        <?php endif; ?>
        </p>
      <?php endif; ?>
      -->

      <div class="card">
        <div class="card-header">Teaching methods</div>
        <div class="card-body">

          <?php function meter($percent) { // --- BEGIN meter fn --- ?>
            <div class="meter-gauge" title="<?php echo sprintf('%d%% match', $percent); ?>">
              <span style="width: <?php echo $percent; ?>%;"></span>
              <?php echo sprintf('%d%% match', $percent); ?>
            </div>
          <?php } // --- END meter fn --- ?>

          <?php foreach ($fetch_all->result->ranking as $index => $results): ?>

            <?php
              $entry = (array) $fetch_all->result->database[$index];
              list($id, $title, $description, $pros, $cons) = $entry;
              // Normalize title, for JS manipulation.
              $title_hash = str_replace(' ', '-', strtolower(trim($title)));

              // Generate a random image.
              $generator = new \Identicon\Generator\SvgGenerator();
              $identicon = new \Identicon\Identicon($generator);
              $identiuri = $identicon->getImageDataUri($title, 150, '#b3d9ff');
            ?>

            <div class="method row mb-5">

              <div class="col-lg-2 col-sm-4">
                <img alt="<?php echo sprintf('Image for %s', $title); ?>"
                  width="150" height="150" src="<?php echo $identiuri; ?>" />
              </div><!-- .col -->

              <div class="col-lg-10 col-sm-8">

                <?php if ($prev_submission): ?>
                  <?php meter(100 * $results->score); ?>
                <?php endif; ?>

              <h4 class="title" id="<?php echo $title_hash; ?>">
                <?php echo $title; ?>
                <span class="fa fa-star-o" aria-hidden="true"
                  data-toggle="tooltip" data-placement="top"></span>
              </h4>

              <?php if ($prev_submission): ?>
                <p class="respect">
                <?php if ($results->mismatches === 0): ?>
                  <span class="text-success">Matches all your selected criteria.</span>
                <?php elseif ($results->mismatches === 1): ?>
                  <span class="text-info">Matches all but one of your criteria.</span>
                <?php elseif ($results->mismatches > 1): ?>
                  <span class="text-danger">
                    <?php echo sprintf('Does not match %d of your criteria', $results->mismatches); ?>
                  </span>
                <?php endif; ?>
                </p>
              <?php endif; ?>

              <div class="description">
                <?php echo $description; ?>
              </div>
              <hr />
              <div class="pros-cons">
                <b>Pros:</b> <?php echo $pros; ?>
                <br/>
                <b>Cons:</b> <?php echo $cons; ?>
              </div>
            </div>
          </div><!-- .col -->

          <?php endforeach; ?>

          <?php if ($prev_submission): ?>
            <div id="loadmore">
              <input type="button" class="btn btn-info" value="Load more" />
            </div>
          <?php endif; ?>

        </div><!-- .card-body -->
      </div><!-- .card -->

      <div id="fb-container">
        <div id="fb-form" class="panel panel-default">
          <form method="POST" action="feedback.php" class="form-horizontal panel-body" role="form">
            <div class="form-group">
              <textarea class="form-control" name="comments" rows="5" autofocus required
                placeholder="Please write your feedback here..."></textarea>
            </div>
            <div role="alert" class="alert alert-danger" id="fb-error">
              <span class="fa fa-exclamation-sign" aria-hidden="true"></span>
              <span class="fb-description"></span>
            </div>
            <div role="alert" class="alert alert-success" id="fb-success">
              <span class="fa fa-ok-sign" aria-hidden="true"></span>
              <span class="fb-description"></span>
            </div>
            <div class="buttons">
              <button class="btn btn-primary" type="submit">Send</button>
              <button class="btn btn-secondary" type="reset">Close</button>
            </div>
          </form>
        </div>
        <div id="fb-tab">Feedback</div>
      </div>

      <footer>
        <p>
        &copy; <?php echo date('Y'); ?> Aalto University.
        <p>
          Teaching methods distilled from
          O. Hyppönen & S. Lindén (2009)
          <i>Handbook for teachers: course structures, teaching methods and assessment.</i>
          Helsinki University of Technology.
        </p>
      </footer>

    </div><!-- .container -->

  </body>
</html>
