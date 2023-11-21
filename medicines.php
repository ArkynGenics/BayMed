<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <title>Medicine List</title>
    <style>
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
            max-width: 900px; /* Set a maximum width for the container */
            margin: 0 auto; /* Center the container */
        }

        .medicine-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            width: 260px; /* Set a fixed width for each medicine box */
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
        <a href="home.php" class="active">Home</a>
        <a href="medicines.php">Medicines</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
        <div style="float: right; padding: 14px 16px;">
            Welcome, <span id="username"><?php echo $_SESSION['username'];?></span>
        </div>
    </nav>
    <?php include "controllers/MedicineList.php" ?>
    <script>
        function showDetails(id) {
            window.location.href = `medicine.php?id=${id}`
        }
    </script>
</body>
</html>
