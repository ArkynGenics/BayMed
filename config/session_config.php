<?php
session_start();

$cookieParams = session_get_cookie_params();
session_set_cookie_params(
    $cookieParams['lifetime'],
    $cookieParams['path'],
    $cookieParams['domain'],
    true,
    true   
);
?>