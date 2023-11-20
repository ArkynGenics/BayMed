<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
    <?php include "controllers/MedicineList.php" ?>
    <script>
        function showDetails(id) {
            window.location.href = `medicine.php?id=${id}`
        }
    </script>
</body>
</html>
