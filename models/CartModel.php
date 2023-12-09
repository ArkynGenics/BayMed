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
    public function viewCart($cart_id) {
        $sql = "SELECT * from carts where id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $cart_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_assoc();
        }else{
            return [];
        }
    }
    public function addToCart($id, $user_id, $quantity) {
        try{
            $sql = "SELECT * from medicines where id = ?;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $statement = $stmt->get_result();
            $medicine = $statement->fetch_assoc();
            if($medicine['quantity'] >= $quantity){
                $this->conn->autocommit(false);
                $stmt1 = $this->conn->prepare("INSERT INTO carts (medicine_id, user_id, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?");
                $stmt1->bind_param('iiii', $id, $user_id,$quantity,$quantity);
                $stmt1->execute();
                // $stmt2 = $this->conn->prepare("UPDATE medicines SET quantity = quantity - ? WHERE id = ?");
                // $stmt2->bind_param('ii', $quantity,$id);
                // $stmt2->execute();
                $this->conn->commit();
                $this->conn->autocommit(true);
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            $this->conn->rollback();
            $this->conn->autocommit(true);
            return false;
        }
    }
    public function deleteFromCart($id) {
        try{
            $sql = "SELECT * from carts where id = ?;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $statement = $stmt->get_result();
            $cart = $statement->fetch_assoc();
            $this->conn->autocommit(false);
            $stmt1 = $this->conn->prepare("DELETE FROM carts where id = ?");
            $stmt1->bind_param('i', $id);
            $stmt1->execute();
            $stmt2 = $this->conn->prepare("UPDATE medicines SET quantity = quantity + ? WHERE id = ?");
            $stmt2->bind_param('ii', $cart['quantity'],$cart['medicine_id']);
            $stmt2->execute();
            $this->conn->commit();
            $this->conn->autocommit(true);
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            $this->conn->autocommit(true);
            return false;
        }
    }
    public function deleteUserCart($id) {
        try{
            $sql = "SELECT * from carts where user_id = ?;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $statement = $stmt->get_result();
            $this->conn->autocommit(false);
            $stmt1 = $this->conn->prepare("DELETE FROM carts where user_id = ?");
            $stmt1->bind_param('i', $id);
            $stmt1->execute();
            while($row = $statement->fetch_assoc()){
                $stmt2 = $this->conn->prepare("UPDATE medicines SET quantity = quantity - ? WHERE id = ?");
                $stmt2->bind_param('ii', $row['quantity'],$row['medicine_id']);
                $stmt2->execute();
            }
            $this->conn->commit();
            $this->conn->autocommit(true);
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            $this->conn->autocommit(true);
            return false;
        }
    }
}


?>