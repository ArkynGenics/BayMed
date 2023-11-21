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

    public function addToCart($id, $quantity) {
        $stmt = $this->conn->prepare("SELECT * FROM medicines where id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicine = $result->fetch_assoc();

        // Insert or update the cart based on the medicine availability
        $stmt = $this->conn->prepare("INSERT INTO carts (user_id, medicine_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
        $stmt->bind_param('iiii', $_SESSION['user_id'], $id, $quantity, $quantity);
        $stmt->execute();
        $stmt->close();
        return $medicine;
    }
}

?>