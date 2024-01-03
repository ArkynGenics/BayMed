<?php

class RegisterController {
    public static function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            self::register();
        }else{
            include_once 'views/register.php';
        }
    }

    public static function register() {
        include_once 'config/connection.php';
        include_once 'models/AuthModel.php';
        $authModel = new AuthModel($conn);
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $full_name = $_POST['full_name'];
        $gender = intval($_POST['gender']);
        $address = $_POST['address'];
        $usernamePattern = '/^[a-zA-Z0-9_-]{3,16}$/';
        $emailPattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($usernamePattern, $username)) {
            $_SESSION["error_message"] = "Username Format is not allowed";
            header("Location: register");
            exit();
        }
        if (!preg_match($emailPattern, $email)) {
            $_SESSION["error_message"] = "Email Format is Incorrect";
            header("Location: register");
            exit();
        }
        $success = $authModel->register($username,$email,$password,$full_name,$address,$gender);
        if ($success) {
            header("Location: ./");
            exit();
        } else {
            $_SESSION["error_message"] = "Failed to Register User";
            header("Location: register");
            exit();
        }
    }
}
?>