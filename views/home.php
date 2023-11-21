<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BayMed</title>
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
        .content {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>BayMed</h1>
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

<div class="content">
    <h2>Welcome to BAYMED</h2>
    <p>A Solution for all your medicine needs.</p>
</div>

<footer>
    &copy; 2023 Baymed
</footer>

</body>
</html>