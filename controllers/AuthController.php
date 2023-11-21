<?php
    include '../config/connection.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user && password_verify($password,$user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['privilege'] = $user['privilege'];
            $_SESSION["success_message"] = "Login Success";
            header("Location: ../home.php");
        } else {
            $_SESSION["error_message"] = "Login Failed";
            header("Location: ../login.php");
        }
    }
?>
