<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize result variable
$result = null;

// Check if search form is submitted
if(isset($_POST['search']) or isset($_POST['input'])) {
    $search_query = $_POST['input'];
   
    
    // SQL query to fetch data based on search query
    $sql = "SELECT * FROM tbl_cars WHERE carname LIKE '%$search_query%' OR model LIKE '%$search_query%'";

    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Cars</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .car-box {
            text-align: center;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .car-item img {
            max-width: 100%;
            max-height: 200px;
        }

        .car-item h2 {
            font-size: 18px;
            margin-top: 10px;
        }

        .wishlist-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #ffc107;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-top: 10px;
        }

        .wishlist-btn:hover {
            background-color: #ffca2c;
            color: #000;
        }
        .view-details-btn {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
        text-decoration: none; /* Remove underline */
    }

    .view-details-btn:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
    <section class="car-grid">
        <?php
        // Display search results
        if(isset($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="car-box">';
                echo '<div class="car-item">';
                
                echo '<img src="' . $row['image'] . '" width="300" alt="' . $row['carname'] . '">';

                echo '<h2>' . $row['carname'] . ' ' . $row['model'] . '</h2>';
                echo '<p>MODEL YEAR: ' . $row['model_year'] . '</p>';
                echo '<p>PRICE: ' . $row['price'] . '</p>';

                // Add a styled button to view details
                echo '<form action="car_details.php" method="GET">';
                echo '<input type="hidden" name="carid" value="' . $row['carid'] . '">';
                echo '<a href="bookings.php?carid=' . $row['carid'] . '" class="view-details-btn">View Details</a>';
                $_GET['carid'] = $row['carid'];

                echo '</form>';

                // Add Wishlist button
                echo '<form action="wishlist.php" method="POST">';
                echo '<input type="hidden" name="carid" value="' . $row['carid'] . '">';
                echo '<input type="submit" name="wishlist" class="wishlist-btn" value="Add to Wishlist"></input>';
                echo '</form>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No cars found.";
        }
        ?>
    </section>
</body>
</html>
