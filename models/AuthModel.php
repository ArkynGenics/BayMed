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
        if ($this->isUsernameExists($username)) {
            return "Username already exists";
        }
        if ($this->isEmailExists($email)) {
            return "Email already exists";
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $username, $email, $hashed_password);
        $success = $stmt->execute();
        if ($success) {
            return "Registration successful";
        } else {
            return "Registration failed";
        }
    }
    private function isUsernameExists($username)
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    private function isEmailExists($email)
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>