<?php

class FeedbackModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listFeedback() {
        $sql = "SELECT * from feedbacks";
        $result = $this->conn->query($sql);
        if ($result) {
            return $result;
        }else{
            return [];
        }
    }
    public function sendFeedback($fullname, $feedback, $file_destination){
        $query = "INSERT INTO feedbacks (fullname, user_feedback, file_path) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $fullname, $feedback, $file_destination);
        $stmt->execute();
        return $stmt;
    }
}

?>