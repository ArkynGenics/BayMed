<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/med.css">
    <title>Medicine List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #4CC9B0;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #4CC9B0;
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
            transition: background-color 0.3s;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .medicine-box:hover {
            background-color: #f9f9f9;
            cursor:pointer
        }

        h3 {
            margin-top: 0;
            font-size: 1.5em;
            color: #4CC9B0;
        }

        p {
            margin: 5px 0;
            color: #333;
        }
        .search-container {
            text-align: center;
            padding: 20px;
        }

        .search-box {
            padding: 10px;
            width: 65%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .search-button {
            padding: 10px;
            background-color: #4CC9B0;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
    <div class="search-container">
        <input type="text" id="searchInput" class="search-box" placeholder="Cari obat..">
        <button onclick="searchMedicine()" class="search-button">Search</button>
    </div>
    <?php
    echo '<div class="medicine-container">';
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $image = $row['file_path'];
        echo '<div class="medicine-box">';
        echo '<img src="'. $image .'" alt="Medicine Image" onclick="showDetails(' . $id . ')" style="max-width: 100%; height: auto;">';
        echo '<h3>' . $name . '</h3>';
        echo '<p>Harga: Rp.' . number_format($price, 2) . '</p>';
        echo '<p>Quantity: ' . $quantity . '</p>';
        echo '</div>';
    }
    echo '</div>';

    ?>
    <script>
        const searchInput = document.getElementById("searchInput");
        searchInput.addEventListener("keypress", function (event) {
        if (event.keyCode == 13) {
            searchMedicine()
        }
        });
        function showDetails(id) {
            window.location.href = `medicine?id=${id}`
        }
        function searchMedicine() {
            const searchInput = document.getElementById("searchInput");
            if(searchInput.value !== ""){
                window.location.href = `medicines?search=${searchInput.value}`
            }
        }
    </script>
</body>
</html>
