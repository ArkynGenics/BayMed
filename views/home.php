<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BayMed</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url('./assets/images/home_bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }

        footer {
            background-color: #4CC9B0;
            color: #000;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
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
        Welcome, <span id="username"><?php echo $_SESSION['full_name'];?></span>
    </div>
</nav>

<div class="content">
    <div class="judulutama">
        <h2>Belanja Obat Mudah dan Aman dengan <br> BAYMED</h2>
    </div>
    <div class="slogan">
        <p>BAYMED adalah platform online terpercaya untuk memenuhi kebutuhan obat Anda. Kami hadir dengan tujuan membuat pengadaan obat menjadi lebih mudah dan terjangkau. Dengan produk-produk obat berkualitas, kami selalu menjaga keamanan dan kepuasan pelanggan</p>
    </div>
    <a href="medicines" class="cta-button">Beli Obat</a>
</div>

<footer>
    &copy; <?php echo date('Y'); ?> BayMed. All rights reserved.
</footer>

</body>
</html>