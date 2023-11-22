<?php

class FeedbackController {
    public static function index() {
        require_once "config/connection.php";
        include_once 'models/FeedbackModel.php';
        include_once 'function/anticsrf.php';
        $feedbackModel = new FeedbackModel($conn);
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: login");
        }
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(validateCSRFToken($_POST['csrf_token'])){
                self::sendFeedback($conn);
            }else{
                $_SESSION['error_message'] = "CSRF Token Failed";
                header('Location: feedback');
            }
        }else{
            generateCSRFToken();
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
        $fullname = htmlspecialchars($_POST["fullname"], ENT_QUOTES, 'UTF-8');
        $feedback = htmlspecialchars($_POST["feedback"], ENT_QUOTES, 'UTF-8');
        $file_destination = "";
        if(!(!isset($_FILES['file-upload']) || $_FILES['file-upload']['error'] === UPLOAD_ERR_NO_FILE)){
            $file_upload = $_FILES["file-upload"];
            $file_name = self::generateRandomFileName($file_upload["name"]);
            $file_tmp = $file_upload["tmp_name"];
            $file_destination = "storage/image/" . $file_name;
            $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            // validasi extension file
            if (!in_array($file_extension, $allowed_extensions)) {
                $_SESSION['error_message'] = "Invalid file extension. Allowed extensions: " . implode(", ", $allowed_extensions);
                header("Location: feedback");
                exit();
            }
            
            // validasi utk ukuran file
            $max_file_size = 500 * 1024;
            if ($file_upload["size"] > $max_file_size) {
                $_SESSION['error_message'] = "File size exceeds the maximum allowed size (500 KB).";
                header("Location: feedback");
                exit();
            }

            // // SANITIZE MOMENT 
            // // 1. Stripping image metadata
            $file_dest_sanitized = $file_destination;
            // if (in_array($file_extension, ["jpg", "jpeg", "png", "gif"])){
            //     $file_dest_sanitized = self::stripImageMetadata($file_destination);
            // }

            // // re-save image using GD library
            // if($file_extension === "jpg" || $file_extension === "jpeg"){
            //     // echo $file_destination;
            //     // $new_gd_image = imagecreatefromjpeg($file_destination);
            //     $new_gd_image = imagecreatefromjpeg("655ce7df0f8e7.jpg");
            //     // jpeg less compression --> but higher qualities ngab
            //     imagejpeg($new_gd_image, $file_dest_sanitized, 100); // set ke 100 (high quality, minimum loss data jugaks)
            //     imagedestroy($new_gd_image);
            // }
            // elseif($file_extension === "png"){
            //     $new_gd_image = imagecreatefrompng($file_destination);
            //     imagepng($new_gd_image, $file_dest_sanitized, 9); // set compression level ke 9, sadly size jadi smaller beda dari JPEG.
            //     imagedestroy($new_gd_image);
            // }
            // elseif($file_extension === "gif"){
            //     $new_gd_image = imagecreatefromgif($file_destination);
            //     imagegif($new_gd_image, $file_dest_sanitized);
            //     imagedestroy($new_gd_image);
            // }

            // pindahin file ke storage
            move_uploaded_file($file_tmp, $file_dest_sanitized);

            // ekstra sanitasi utk file name nih goks.
            $file_destination = htmlspecialchars($file_dest_sanitized, ENT_QUOTES, 'UTF-8');
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

    public static function stripImageMetadata($imagePath) {
        exec("exiftool -all= {$imagePath}");
        return $imagePath;
    }
}



?>