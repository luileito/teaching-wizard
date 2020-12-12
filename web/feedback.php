<?php
if (empty($_POST)) exit;

$the_day = date(DATE_RFC2822);
$user_ip = '0.0.0.0';
$ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
foreach ($ip_keys as $k) {
    $val = $_SERVER[$k];
    if (!empty($val)) {
        $user_ip = $val;
        break;
    }
}

$contents  = "Date: $the_day".PHP_EOL;
$contents .= "From: $user_ip".PHP_EOL;
$contents .= filter_var($_POST['comments'], FILTER_SANITIZE_STRING).PHP_EOL;
$contents .= "---".PHP_EOL;

$bytes = file_put_contents('feedback.log', $contents, FILE_APPEND);
if ($bytes > 0) {
    echo 'Feedback sent!';
} else {
    echo 'Something wrong happened :(';
}
