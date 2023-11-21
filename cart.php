<?php
session_start();
?>
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
    <a href="home.php" class="active">Home</a>
    <a href="medicines.php">Medicines</a>
    <a href="cart.php">Cart</a>
    <a href="logout.php">Logout</a>
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
            <!-- Dummy data, replace with dynamic data from your database -->
            <tr>
                <td>1</td>
                <td>Medicine A</td>
                <td>$10.00</td>
                <td>2</td>
                <td>$20.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Medicine B</td>
                <td>$15.00</td>
                <td>3</td>
                <td>$45.00</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total:</strong> $65.00</p>
    </div>
</div>

</body>
</html>
