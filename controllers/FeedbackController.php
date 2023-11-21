<?php

class FeedbackController {
    public static function index() {
        require_once "config/connection.php";
        include_once 'models/FeedbackModel.php';
        $feedbackModel = new FeedbackModel($conn);
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: login");
        }
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            self::sendFeedback($conn);
        }else{
            $feedbacks = $feedbackModel->listFeedback();
            include_once 'views/feedback.php';
        }
    }
    static function generateRandomFileName($original_name)
    {
        $uuid = uniqid();
        $file_extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        return $uuid . "." . $file_extension;
    }
    public static function sendFeedback($conn){
        $fullname = $_POST["fullname"];
        $feedback = $_POST["feedback"];
        $file_destination = "";
        if(!(!isset($_FILES['file-upload']) || $_FILES['file-upload']['error'] === UPLOAD_ERR_NO_FILE)){
            $file_upload = $_FILES["file-upload"];
            $file_name = self::generateRandomFileName($file_upload["name"]);
            $file_tmp = $file_upload["tmp_name"];
            $file_destination = "storage/image/" . $file_name;
            $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_extensions)) {
                $_SESSION['error_message'] = "Invalid file extension. Allowed extensions: " . implode(", ", $allowed_extensions);
                header("Location: feedback");
                exit();
            }
            $max_file_size = 500 * 1024;
            if ($file_upload["size"] > $max_file_size) {
                $_SESSION['error_message'] = "File size exceeds the maximum allowed size (5 MB).";
                header("Location: feedback");
                exit();
            }
            move_uploaded_file($file_tmp, $file_destination);
        }
        $feedbackModel = new FeedbackModel($conn);
        $stmt = $feedbackModel->sendFeedback($fullname, $feedback, $file_destination);
        if ($stmt->affected_rows === 1) {
            $_SESSION['success_message'] = "Feedback Sent";
            header("Location: feedback");
        } else {
            $_SESSION['error_message'] = "Failed to send feedback";
            header("Location: feedback");
        }
    }
}
?>