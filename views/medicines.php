<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <title>Medicine List</title>
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
        h2 {
            text-align: center;
            color: #333;
        }

        .medicine-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            max-width: 1208px; /* Set a maximum width for the container */
            margin: 0 auto; /* Center the container */
            padding-top: 50px;
        }

        .medicine-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            width: 20%; /* Set a fixed width for each medicine box */
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .medicine-box:hover {
            background-color: #f9f9f9;
        }

        h3 {
            margin-top: 0;
            font-size: 1.5em;
            color: #3498db;
        }

        p {
            margin: 5px 0;
            color: #333;
        }
    </style>
</head>
<body>
<header>
    <h1>Medicine List</h1>
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
    <?php 
    echo '<div class="medicine-container">';
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        echo '<div class="medicine-box">';
        echo '<img src="storage/image/panadol.png" alt="Medicine Image" onclick="showDetails(' . $id . ')" style="max-width: 100%; height: auto;">';
        echo '<h3>' . $name . '</h3>';
        echo '<p>Price: $' . number_format($price, 2) . '</p>';
        echo '<p>Quantity: ' . $quantity . '</p>';
        echo '</div>';
    }
    echo '</div>';

    ?>
    <script>
        function showDetails(id) {
            window.location.href = `medicine?id=${id}`
        }
    </script>
</body>
</html>
