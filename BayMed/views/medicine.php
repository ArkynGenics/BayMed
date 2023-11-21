<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/navbar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .content {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            /* margin: 0;
            padding: 0; */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .medicine-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .medicine-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .medicine-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .medicine-price {
            color: #27ae60;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .medicine-quantity {
            color: #3498db;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .medicine-description {
            font-size: 16px;
            color: #666;
        }
        .addToCart-button {
            background-color: #4CC9B0;
            color: #000;
            padding: 9px 17px;
            font-weight: bold;
            border-radius: 5px;
            align-items: left;
            border: 0px;
            cursor: pointer;
        }
        .back-button{
            text-align: left;
            color: #000;
            cursor: pointer;
            width: 15px;
        }
        .back-button:hover {
            color: #3498db;
        }
    </style>
</head>
<body>
    <nav>
        <a href="home" class="active">Home</a>
        <a href="medicines">Medicines</a>
        <a href="cart">Cart</a>
        <a href="feedback">Feedback</a>
    </nav>
    <p style="color: green;"><?php if(isset($_SESSION['success_message'])){echo $_SESSION['success_message'];unset($_SESSION['success_message']);}?></p>
    <p style="color: red;"><?php if(isset($_SESSION['error_message'])){echo $_SESSION['error_message']; unset($_SESSION['error_message']);}?></p>
    <div class="content">
        <div class="medicine-container">
            <div class="back-button" onclick="window.location.href='./medicines'">Back</div>
            <img class="medicine-image" src="storage/image/panadol.png" alt="Medicine Image">
            <div class="medicine-name"><?php echo $medicine['name']; ?></div>
            <div class="medicine-price">$<?php echo $medicine['price']; ?> / pack</div>
            <div class="medicine-quantity">Stock: <?php echo $medicine['quantity']; ?></div>
            <div class="medicine-description">
            <?php echo $medicine['description']; ?>
            <br><br>
            <!-- form blm diubah -->
            <form action=# method="POST">
                <label for="quantity">Quantity:</label>
                <input type="hidden" name="medicine_id" value="<?php echo $medicine['id']?>"/>
                <input type="hidden" name="action" value="add_to_cart"/>
                <input type="number" id="quantity" name="quantity" min="1">
                <br><br>
                <button class="addToCart-button">Add to Cart</button>
            </form>
            </div>
        </div>
    </div>
</body>
</html>