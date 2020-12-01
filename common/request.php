<?php

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
