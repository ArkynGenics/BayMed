<?php
    include './connection.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO users (username,email,password) values (?,?,?)');
        $stmt->bind_param('sss',$username,$email,$hashed_password);
        $success = $stmt->execute();
        if ($success) {
            $_SESSION["success_message"] = "User Registered Successfully";
            header("Location: ../register.php");
        } else {
            $_SESSION["error_message"] = "Failed to Register User";
            header("Location: ../login.php");
        }
    }
?>