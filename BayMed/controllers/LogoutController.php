<?php 
class LogoutController {
    public static function index() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: login");
    }
}
?>