<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        header("Location: home");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>BayMed Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            width: 300px;
            padding: 16px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #4cc9b0;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #4cc9b0;
            box-sizing: border-box;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: white;
            background-color: #4cc9b0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #3db59d;
        }

        .register-button{
            cursor: pointer;
            margin-top: 10px;
            text-align: center;
            color: #4cc9b0;
            font-size: 13px
        }
        .register-button:hover{
            color: lightblue;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Registration</h2>
        <form action="#" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <div class="register-button" onclick="window.location.href='login'"><b>Sudah punya akun? Masuk Cepat!</b></div>
        <p style="color: green;"><?php if(isset($_SESSION['success_message'])){ echo $_SESSION['success_message'];unset($_SESSION['success_message']);}?></p>
        <p style="color: red;"><?php if(isset($_SESSION['error_message'])){ echo $_SESSION['error_message'];unset($_SESSION['error_message']);}?></p>
    </div>
</body>
</html>
