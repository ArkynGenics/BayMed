<?php
    include 'connection.php';
    $sql = "SELECT id,name, price, quantity FROM medicines";
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            // echo '<div class="medicine-box" onclick="showDetails(' . $id . ')">';
            // echo '<h3>' . $name . '</h3>';
            // echo '<p>Price: $' . number_format($price, 2) . '</p>';
            // echo '<p>Quantity: ' . $quantity . '</p>';
            // echo '</div>';
            echo '<div class="medicine-box" onclick="showDetails(' . $id . ')">';
            echo '<img src="storage/image/panadol.png" alt="Medicine Image" style="max-width: 100%; height: auto;">';
            echo '<h3>' . $name . '</h3>';
            echo '<p>Price: $' . number_format($price, 2) . '</p>';
            echo '<p>Quantity: ' . $quantity . '</p>';
            echo '<button onclick="addToCart(' . $id . ', \'' . $name . '\', ' . $price . ')">Add to Cart</button>';
            echo '</div>';
        }
    }
?>