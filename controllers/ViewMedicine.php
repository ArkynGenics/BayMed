<?php
    include 'connection.php';
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM medicines where id = ?");
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $medicine = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
?>