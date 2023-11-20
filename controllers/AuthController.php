<?php
    include './connection.php';
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION["success_message"] = "Login Success";
            header("Location: ../messages.php");
        } else {
            $_SESSION["error_message"] = "Login Failed";
            header("Location: ../login.php");
        }
    }
?>
