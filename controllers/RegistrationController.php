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
        $usernamePattern = '/^[a-zA-Z0-9_-]{3,16}$/';
        $emailPattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($usernamePattern, $username)) {
            $_SESSION["error_message"] = "Username Format is not allowed";
            header("Location: register");
        }
        if (!preg_match($emailPattern, $email)) {
            $_SESSION["error_message"] = "Email Format is Incorrect";
            header("Location: register");
        }
        $success = $authModel->register($username,$email,$password);
        if ($success) {
            header("Location: ./");
        } else {
            $_SESSION["error_message"] = "Failed to Register User";
            header("Location: register");
        }
    }
}
?>