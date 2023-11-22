<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <title>User Feedback Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border-radius: 4px
        }

        button {
            padding: 10px;
            background-color: #4cc9b0;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #3db59d;
        }
        .feedback-list {
            margin-top: 30px;
            font-size: 14px;
        }

        .feedback-item {
            border: 1px solid #808080;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .feedback-image {
            max-width: 100%;
            max-height: 200px; /* Adjust as needed */
        }
        .container {
            margin: 50px 150px 0 150px;
        }
        .title{
            text-align: center;
        }
        #fullname{
            border: 1px solid #4cc9b0;
        }
        #feedback{
            border: 1px solid #4cc9b0;
        }
        .submit{
            background-color: #4cc9b0;
            color: #000;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            border: 10px;
            margin-right: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <a href="." class="active">Home</a>
        <a href="medicines">Medicines</a>
        <a href="cart">Cart</a>
        <a href="feedback">Feedback</a>
        <div style="float: right; padding: 0px 16px;">
            <a href="logout">Logout</a>
        </div>
        <div style="float: right; padding: 14px 16px;">
            Welcome, <span id="username"><?php echo $_SESSION['username'];?></span>
        </div>
    </nav>
    <div class="container">
        <h2 class="title">User Feedback Form</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            <label for="fullname" style=font-size:14px;>Your Name:</label>
            <input type="text" id="fullname" name="fullname" required>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']?>"/>
            <label for="feedback" style=font-size:14px;>Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" required></textarea>

            <label for="file-upload" style=font-size:14px;>Upload File:</label>
            <input type="file" id="file-upload"  name="file-upload">

            <button type="submit" class="submit" style=color:black;><b>Submit</b></button>
        </form>

        <p style="color: green;"><?php if(isset($_SESSION['success_message'])){echo $_SESSION['success_message'];unset($_SESSION['success_message']);}?></p>
        <p style="color: red;"><?php if(isset($_SESSION['error_message'])){echo $_SESSION['error_message']; unset($_SESSION['error_message']);}?></p>
        
        <h3 class="title" style=margin-top:100px;>Feedback List</h3>
        <div class="feedback-list">
            <?php
            foreach ($feedbacks as $feedback) {
                echo '<div class="feedback-item">';
                echo '<strong>Name:</strong><br> ' . $feedback['fullname'] . '<br><br>';
                echo '<strong>Feedback:</strong><br> ' . $feedback['user_feedback'] . '<br><br>';
                if ($feedback['file_path'] !== "") {
                    echo '<strong>Image:</strong> <br>';
                    echo '<img class="feedback-image" src="' . $feedback['file_path'] . '" alt="Feedback Image"><br><br>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>