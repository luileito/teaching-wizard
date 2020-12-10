<?php if (!isset($_SERVER['PHP_AUTH_USER'])) header('Location: index.php'); ?>
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="main.css" />
  </head>
  <body>
    <div class="container-fluid global">

      <?php
      require_once '../config.php';
      require_once '../common/request.php';
      global $CONFIG, $UI_PARAMS;

      if (!empty($_POST)) {
          $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

          if (!empty($_POST['delete'])) {
              $delete = do_request($CONFIG->API_SERVER.'?action=delete&id='.$id);
              if ($delete->error !== FALSE) {
                  die('<p class="alert alert-warning">Cannot delete entry. Please try again later.</p>');
              }
          } elseif (!empty($_POST['insert'])) {
              // Submit only the data we want to insert in the DB.
              unset($_POST['insert']);

              $insert = do_request($CONFIG->API_SERVER.'?action=insert', $_POST);
              if ($insert->error !== FALSE) {
                  die('<p class="alert alert-warning">Cannot add entry. Please try again later.</p>');
              }
          } else {
              $update = do_request($CONFIG->API_SERVER.'?action=update&id='.$id, $_POST);
              if ($update->error !== FALSE) {
                  die('<p class="alert alert-warning">Cannot update entry. Please try again later.</p>');
              }
              $is_save = TRUE;
          }
      }

      if (isset($_GET['edit'])) {
          $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
          $fetch_one = do_request($CONFIG->API_SERVER.'?action=getone&id='.$id);

          if ($fetch_one->error !== FALSE) {
              die('<p class="alert alert-warning">'.sprintf('Cannot find entry with id %s.', $id).'</p>');
          }
          $entry = $fetch_one->result;
      }

      $fetch_all = do_request($CONFIG->API_SERVER);
      if ($fetch_all->error !== FALSE) {
          die('<p class="alert alert-warning">API server not working. Please try again later.</p>');
      }
      // FIXME: Homogeneize the data format: Array or StdClass for all?
      $database = (array) $fetch_all->result->database;
      ?>


      <?php if (isset($is_save)): ?>
        <p class="alert alert-success">Method successfully updated.</p>
      <?php endif; ?>

      <div class="container">
        <div class="row">
          <div class="col">

            <?php if (isset($entry)): ?>
              <h1>Edit method</h1>
            <?php else: ?>
              <h1>Add new method</h1>
            <?php endif; ?>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control"
                  name="title" <?php if (isset($entry)) echo 'value="'.$entry->title.'"'; ?> />
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="4"
                  name="description"><?php if (isset($entry)) echo $entry->description; ?></textarea>
              </div>

              <div class="form-group">
                <label>Pros/Strengths</label>
                <textarea class="form-control" rows="3"
                  name="pros"><?php if (isset($entry)) echo $entry->pros; ?></textarea>
              </div>

              <div class="form-group">
                <label>Cons/Challenges</label>
                <textarea class="form-control" rows="3"
                  name="cons"><?php if (isset($entry)) echo $entry->cons; ?></textarea>
              </div>

              <div class="form-group">
                <div class="row ranges">
                  <div class="col">
                    <label>Method scores</label>
                  </div>
                  <div class="col">
                    <label>Min</label>
                  </div>
                  <div class="col">
                    <label>Max</label>
                  </div>
                </div>

                <?php foreach ($UI_PARAMS as $key => $value): ?>
                  <?php $arr = isset($entry) ? (array) $entry : NULL; ?>
                  <div class="row ranges">
                    <div class="col">
                      <span class="block"><?php echo $key; ?></span>
                    </div>
                    <div class="col">
                      <input type="number" name="min_<?php echo $key; ?>" min="1" max="5"
                        value="<?php echo isset($entry) ? $arr["min_{$key}"] : $value; ?>" />
                    </div>
                    <div class="col">
                      <input type="number" name="max_<?php echo $key; ?>" min="1" max="5"
                        value="<?php echo isset($entry) ? $arr["max_{$key}"] : $value; ?>" />
                    </div>
                  </div><!-- .row -->
                <?php endforeach; ?>
              </div>

              <hr />

              <?php if (isset($entry)): ?>
              <input type="hidden" name="id" value="<?php echo $entry->id; ?>" />
              <input class="btn btn-primary" type="submit" value="Update" />
              <input class="btn btn-danger" type="submit" name="delete" value="Delete" />
              <?php else: ?>
              <input class="btn btn-primary" type="submit" value="Add" />
              <?php endif; ?>

            </form>
          </div><!-- .col -->

          <div class="col">
            <h1>Available methods</h1>
            <ol>
            <?php
            foreach ($database as $entry) {
                list($id, $title, $description, $pros, $cons) = $entry;
                echo '<li><a href="'.$_SERVER['PHP_SELF'].'?edit&id='.$id.'">'.$title.'</a></li>';
            }
            ?>
            </ol>
          </div><!-- .col -->

        </div><!-- .row -->
      </div><!-- .container -->

    </div><!-- .container-fluid -->
  </body>
</html>
