<?php
require '../config.php';
global $CONFIG;

if ($CONFIG->AUTH_HASH == '') {
    die('Please edit config.php and setup your authentication options.');
}

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {

    header('WWW-Authenticate: Basic realm="Teaching Methods Realm"');
    header('HTTP/1.0 401 Unauthorized');

    echo 'Authentication is required to access this site.';
    exit;

} else {
    if ($_SERVER['PHP_AUTH_USER'] !== $CONFIG->AUTH_USER
        || !password_verify($_SERVER['PHP_AUTH_PW'], $CONFIG->AUTH_HASH)
    ) {
        echo 'Wrong credentials.';
        exit;
    }

    // At his point the user is authenticated.
    include 'main.php';

}
