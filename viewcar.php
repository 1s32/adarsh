<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cars</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link to your custom CSS file -->
    <link rel="stylesheet" href="style22.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .car-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .car-table th,
        .car-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .car-table th {
            background-color: #f5f5f5;
            color: #333;
            font-weight: bold;
        }
        .car-image {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <?php    
    include "navbar.php";
    ?>

    <div class="container mt-5">
     

        <?php
        // Database connection settings
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "car";

        // Create a new connection
        $conn = new mysqli($host, $username, $password, $database);

        // Check if the connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to retrieve car data
        $sql = "SELECT * FROM tbl_cars";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display car data in a table
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped car-table'>";
            echo "<thead class='thead-dark'>";
            echo "<tr><th>Car Name</th><th>Model</th><th>Model Year</th><th>Price</th><th>Mileage</th><th>Km Travelled</th><th>Image</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['carname'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['model_year'] . "</td>";
                echo "<td>RS " . $row['price'] . "</td>";
                echo "<td>" . $row['milege'] . "</td>";
                echo "<td>" . $row['km'] . "</td>";
                echo "<td><img src='" . $row['image'] . "' alt='Car Image' class='car-image img-thumbnail'></td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            // If no cars are added yet, show an error message
            echo "<div class='alert alert-danger' role='alert'>No cars added yet by the admin</div>";
        }

        // Close the database connection
        $conn->close(); 
        ?>
    </div>

    <!-- Link to Bootstrap JS and jQuery (for Bootstrap functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
