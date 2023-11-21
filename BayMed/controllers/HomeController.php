<?php
class HomeController {
    public static function index() {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: login");
        }
        include_once 'views/home.php';
    }
}
?>