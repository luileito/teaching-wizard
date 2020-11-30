<?php
// === UI search params ===
// Each param is defined in the [1,5] range.
// We begin with neutral scores by default.
$UI_PARAMS = array(
  'group_size' => 3,
  'student_workload' => 3,
  'teacher_workload' => 3,
  'student_experience' => 3,
  'teacher_experience' => 3,
  'student_interaction' => 3,
);

// === Authentication options ===
// Generate a custom hash for authentication based on a secret "salt".
// The hash is assumed to be a concatenation of user + salt + password with a colon.
// Example: to add a user name"hello" with password "world", execute this command via CLI:
// echo -n "hello:some secret:world" | md5sum
$AUTH_SALT = 'some secret';
$AUTH_HASH = '9284c0d2314dca7dbace2b782d781717';

//
// Don't edit below this line!
//
$cfg_file = dirname(__FILE__).'/config.json';
$CONFIG = json_decode(file_get_contents($cfg_file));

function do_request($url, $data = NULL) {
    $options = array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_SSL_VERIFYPEER => TRUE,
        CURLOPT_HEADER         => FALSE,
    );

    if (!empty($data)) {
        $options += array(
            CURLOPT_POST       => TRUE,
            CURLOPT_POSTFIELDS => http_build_query($data),
        );
    }

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    curl_close($ch);

    return json_decode($content);
}
