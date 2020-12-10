<?php
require '../config.php';
global $CONFIG;

if ($CONFIG->AUTH_HASH == '') {
    die('Please edit config.php and setup your authentication options.');
}

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {

    header('WWW-Authenticate: Basic realm="Teaching Methods Realm"');
    header('HTTP/1.0 401 Unauthorized');

    die('Authentication is required to access this site.');

} else {

    if ($_SERVER['PHP_AUTH_USER'] !== $CONFIG->AUTH_USER
        || !password_verify($_SERVER['PHP_AUTH_PW'], $CONFIG->AUTH_HASH)
    ) {
        die('Wrong credentials.');
    }

    // At his point the user is authenticated.
    include 'main.php';

}
