<?php

$email = "12345666666";
$v_code = "123456";

$var = include ('form_verify.php');

function sendMail($body) {
    echo $body;
}

sendMail($var);

?>