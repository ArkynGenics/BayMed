<?php
    include 'connection.php';
    
    function listMedicine(){
        global $conn;
        $sql = "SELECT id,name, price, quantity FROM medicines";
        $result = $conn->query($sql);
        if ($result) {
            return $result;
        }
    }
    function getMedicine($id){
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