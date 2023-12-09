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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
        }

        .medicine-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 1000px;
            width: 100%;
            overflow-y: auto; 
            max-height: 70vh;
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
            text-align: justify;
            margin-top: 15px;
        }
        .addToCart-button {
            background-color: #4CC9B0;
            color: #000;
            padding: 9px 15px;
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
        <a href="./" class="active">Home</a>
        <a href="medicines">Medicines</a>
        <a href="cart">Cart</a>
        <a href="feedback">Feedback</a>
    </nav>
    <div class="content">
        <div class="medicine-container">
            <div class="back-button" onclick="window.location.href='./medicines'">Back</div>
            <img class="medicine-image" src="<?php echo $medicine['file_path'];?>" alt="Medicine Image">
            <div class="medicine-name"><?php echo $medicine['name']; ?></div>
            <div class="medicine-price">Rp.<?php echo $medicine['price']; ?>/<?php echo $medicine['unit']; ?></div>
            <div class="medicine-quantity">Stok: <?php echo $medicine['quantity']; ?></div>
            <form action=# method="POST">
                <label for="quantity">Quantity:</label>
                <input type="hidden" name="medicine_id" value="<?php echo $medicine['id']?>"/>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']?>"/>
                <input type="hidden" name="action" value="add_to_cart"/>
                <input type="number" id="quantity" name="quantity" min="1" style="width: 40px; padding: 7px " required>
                <button class="addToCart-button">Add to Cart</button>
            </form>
            <p style="color: green;"><?php if(isset($_SESSION['success_message'])){echo $_SESSION['success_message'];unset($_SESSION['success_message']);}?></p>
            <p style="color: red;"><?php if(isset($_SESSION['error_message'])){echo $_SESSION['error_message']; unset($_SESSION['error_message']);}?></p>
            <div class="medicine-description" style="white-space: pre-line"><p><strong>Deskripsi</strong><p>
            <?php echo $medicine['description']; ?>
            </div>
            <div class="medicine-description "style="white-space: pre-line"><p><strong>Komposisi</strong><p>
            <?php echo $medicine['komposisi']; ?>
            </div>
            <div class="medicine-description "style="white-space: pre-line"><p><strong>Indikasi</strong><p>
            <?php echo $medicine['indikasi']; ?>
            </div>
            <div class="medicine-description "style="white-space: pre-line"><p><strong>Dosis</strong><p>
            <?php echo $medicine['dosis']; ?>
            </div>
            <div class="medicine-description "style="white-space: pre-line"><p><strong>Aturan Pakai</strong><p>
            <?php echo $medicine['aturan_pakai']; ?>
            </div>
            <div class="medicine-description "style="white-space: pre-line"><p><strong>Efek Samping</strong><p>
            <?php echo $medicine['efek']; ?>
            </div>
            <div class="medicine-description "style="white-space: pre-line"><p><strong>Golongan Obat</strong><p>
            <?php echo $medicine['golongan']; ?>
            </div>
            <div class="medicine-description "style="white-space: pre-line"><p><strong>Kemasan</strong><p>
            <?php echo $medicine['kemasan']; ?>
            </div>
            <div class="medicine-description "style="white-space: pre-line"><p><strong>Manufaktur</strong><p>
            <?php echo $medicine['manufaktur']; ?>
            </div>

        </div>
    </div>
</body>
</html>