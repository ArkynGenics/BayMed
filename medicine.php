<?php include "controllers/ViewMedicine.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
    </style>
</head>
<body>

    <div class="medicine-container">
        <img class="medicine-image" src="storage/image/panadol.png" alt="Medicine Image">
        <div class="medicine-name"><?php echo $medicine['name']; ?></div>
        <div class="medicine-price"><?php echo $medicine['price']; ?></div>
        <div class="medicine-quantity">Quantity: <?php echo $medicine['quantity']; ?></div>
        <div class="medicine-description">
        <?php echo $medicine['description']; ?>
        </div>
    </div>

</body>
</html>
