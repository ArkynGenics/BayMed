<?php

class CartModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listCart($user_id) {
        $sql = "SELECT c.id as cart_id, m.name as medicine_name, m.price as medicine_price, c.quantity, (m.price * c.quantity) as total_price
        FROM carts c
        JOIN medicines m ON c.medicine_id = m.id
        WHERE c.user_id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return $result;
        }
    }

    public function addToCart($id, $user_id, $quantity) {
        $stmt = $this->conn->prepare("INSERT INTO carts (medicine_id, user_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
        $stmt->bind_param('iiii', $id, $user_id,$quantity,$quantity);
        $success = $stmt->execute();
        return $success;
    }
}

?>