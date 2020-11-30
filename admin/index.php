<?php
require '../config.php';

if ($AUTH_SALT == 'some secret' || $AUTH_HASH = '9284c0d2314dca7dbace2b782d781717') {
    die('Please edit config.php and setup your authentication options.');
}

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {

    header('WWW-Authenticate: Basic realm="Teaching Methods Realm"');
    header('HTTP/1.0 401 Unauthorized');

    echo 'Authentication is required to access this site.';
    exit;

} else {

    $hash = md5($_SERVER['PHP_AUTH_USER'].':'.$AUTH_SALT.':'.$_SERVER['PHP_AUTH_PW']);
    if ($hash !== $AUTH_HASH) {
        echo 'Wrong credentials.';
        exit;
    }

    // At his point the user is authenticated.
    include 'main.php';

}
