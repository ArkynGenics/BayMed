<?php

class LoginController {
    public static function index() {
        include_once 'views/login.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            self::login();
        }
    }

    public static function login() {
        include_once 'config/connection.php';
        include_once 'models/AuthModel.php';
        $authModel = new AuthModel($conn);
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $authModel->login($username,$password);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['privilege'] = $user['privilege'];
                $_SESSION['success_message'] = 'Login success';
                header('Location: home');
                exit;
            } else {
                $_SESSION['error_message'] = 'Login failed';
                header('Location: login');
                exit;
            }
        }
    }
}