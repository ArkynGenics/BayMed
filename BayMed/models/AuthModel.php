<?php
    class AuthModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function login($username,$password){
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }
    public function register($username,$email,$password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare('INSERT INTO users (username,email,password) values (?,?,?)');
        $stmt->bind_param('sss',$username,$email,$hashed_password);
        $success = $stmt->execute();
        return $success;
    }
}
?>