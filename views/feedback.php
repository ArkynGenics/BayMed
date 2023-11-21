<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
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
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
        .feedback-list {
            margin-top: 40px;
        }

        .feedback-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .feedback-image {
            max-width: 100%;
            max-height: 200px; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <h2>User Feedback Form</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="fullname">Your Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="feedback">Feedback:</label>
        <textarea id="feedback" name="feedback" rows="4" required></textarea>

        <label for="file-upload">Upload File:</label>
        <input type="file" id="file-upload" name="file-upload">

        <button type="submit">Submit Feedback</button>
    </form>
    <p style="color: green;"><?php if(isset($_SESSION['success_message'])){echo $_SESSION['success_message'];unset($_SESSION['success_message']);}?></p>
    <p style="color: red;"><?php if(isset($_SESSION['error_message'])){echo $_SESSION['error_message']; unset($_SESSION['error_message']);}?></p>
    <div class="feedback-list">
        <h3>Feedback List</h3>
        <?php
        foreach ($feedbacks as $feedback) {
            echo '<div class="feedback-item">';
            echo '<strong>Name:</strong> ' . $feedback['fullname'] . '<br>';
            echo '<strong>Feedback:</strong> ' . $feedback['user_feedback'] . '<br>';
            if ($feedback['file_path'] !== "") {
                echo '<strong>Image:</strong> <br>';
                echo '<img class="feedback-image" src="' . $feedback['file_path'] . '" alt="Feedback Image"><br>';
            }
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>