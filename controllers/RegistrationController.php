<?php

class RegisterController {
    public static function index() {
        include_once 'views/register.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            self::register();
        }
    }

    public static function register() {
        include_once 'config/connection.php';
        include_once 'models/AuthModel.php';
        $authModel = new AuthModel($conn);
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $success = $authModel->register($username,$email,$password);
        if ($success) {
            $_SESSION["success_message"] = "User Registered Successfully";
            header("Location: home");
        } else {
            $_SESSION["error_message"] = "Failed to Register User";
            header("Location: register");
        }
    }
}
?>