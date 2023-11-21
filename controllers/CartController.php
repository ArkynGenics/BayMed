<?php
    include 'connection.php';
    
    function listCart($user_id){
        global $conn;
        $sql = "SELECT c.id as cart_id, m.name as medicine_name, m.price as medicine_price, c.quantity, (m.price * c.quantity) as total_price
        FROM carts c
        JOIN medicines m ON c.medicine_id = m.id
        WHERE c.user_id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return $result;
        }
    }
    function addToCart($id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM medicines where id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $medicine = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $medicine;
    }
?>