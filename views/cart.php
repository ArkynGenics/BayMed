<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <title>Shopping Cart</title>
    <style>
        h2 {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            margin-top: 60px;
            margin-left: 150px;
        }
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
            margin: 0 150px 0 150px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            
        }

        th {
            background-color: #4CC9B0;
            color: #000;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .total {
        margin-top: 100px;
        background-color: #4CC9B0;
        padding: 5px 5px 5px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: center;
        }

        .checkout_button {
            background-color: red;
            color: #000;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            border: 10px;
            margin-right: 20px;
            cursor: pointer;
        }
        .idid{
            text-align: center;
        }
        .qty{
            text-align: center;
        }
        .price{
            text-align: center;
        }
        .price-total{
            text-align: right;
        }
        .delete-item{
            border: none;    
        }
        .delete-item a {
            text-decoration: none;
            color: red;
        }
    </style>
</head>
<body>

<nav>
    <a href="./" class="active">Home</a>
    <a href="medicines">Medicines</a>
    <a href="cart">Cart</a>
    <a href="feedback">Feedback</a>
    <div style="float: right; padding: 0px 16px;">
        <a href="logout">Logout</a>
    </div>
    <div style="float: right; padding: 14px 16px;">
        Welcome, <span id="username"><?php echo $_SESSION['username'];?></span>
    </div>
</nav>

<h2>My Cart</h2>

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
        <script>
        function deleteForm(id) {
            var form = document.createElement("form");
            form.method = "post"; 
            form.action = "";  
            var actionInput = document.createElement("input");
            actionInput.type = "hidden";
            actionInput.name = "action";  
            actionInput.value = "delete_cart";
            var idInput = document.createElement("input");
            idInput.type = "hidden";
            idInput.name = "id"; 
            idInput.value = id;
            var csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "csrf_token"; 
            csrfToken.value = "<?php echo $_SESSION['csrf_token'];?>";
            form.appendChild(actionInput);
            form.appendChild(idInput);
            form.appendChild(csrfToken);
            document.body.appendChild(form);
            form.submit();
        }
        </script>
        <tbody>
            <?php
            $rowNumber = 0; 
            $cartPrice = 0;
            while ($row = $result->fetch_assoc()) {
                $rowNumber++;
                echo '<tr>';
                echo '<td  class="idid">' . $rowNumber. '</td>';
                echo '<td>' . $row['medicine_name'] . '</td>';
                echo '<td class="price">$' . number_format($row['medicine_price'], 2) . '</td>';
                echo '<td class="qty">' . $row['quantity'] . '</td>';
                echo '<td class="price-total">$' . number_format($row['total_price'], 2) . '</td>';
                echo '<td class="delete-item"><a href="#" onclick="deleteForm('. $row['cart_id'].');">X</a></td>';
                echo '</tr>';
                $cartPrice += $row['total_price'];
            }

            ?>
        </tbody>
    </table>

    <div class="total">
        <h4>Total : <strong>$<?php echo number_format($cartPrice, 2)?></strong> </h4>
        <button class="checkout_button" onclick="#">Check Out</button>
    </div>

    <p style="color: green;"><?php if(isset($_SESSION['success_message'])){echo $_SESSION['success_message'];unset($_SESSION['success_message']);}?></p>
    <p style="color: red;"><?php if(isset($_SESSION['error_message'])){echo $_SESSION['error_message']; unset($_SESSION['error_message']);}?></p>
</div>

</body>
</html>
