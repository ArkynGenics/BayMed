<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <title>Shopping Cart</title>
    <style>
        
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        .container {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>

<header>
    <h1>Shopping Cart</h1>
</header>
<nav>
    <a href="home" class="active">Home</a>
    <a href="medicines">Medicines</a>
    <a href="cart">Cart</a>
    <a href="logout">Logout</a>
    <div style="float: right; padding: 14px 16px;">
        Welcome, <span id="username"><?php echo $_SESSION['username'];?></span>
    </div>
</nav>
<div class="container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cart = new CartModel($conn);
            $result = $cart->listCart($_SESSION['user_id']);
            $rowNumber = 0; 
            $cartPrice = 0;
            while ($row = $result->fetch_assoc()) {
                $rowNumber++;
                echo '<tr>';
                echo '<td>' . $rowNumber. '</td>';
                echo '<td>' . $row['medicine_name'] . '</td>';
                echo '<td>$' . number_format($row['medicine_price'], 2) . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '<td>$' . number_format($row['total_price'], 2) . '</td>';
                echo '</tr>';
                $cartPrice += $row['total_price'];
            }

            ?>
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total:</strong>$<?php echo number_format($cartPrice, 2)?> </p>
    </div>
</div>

</body>
</html>
