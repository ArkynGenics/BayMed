<?php
function generateCSRFToken() {
    $token = bin2hex(random_bytes(32)); 
    $_SESSION['csrf_token'] = $token; 
    return $token;
}

function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token'];
}
?>