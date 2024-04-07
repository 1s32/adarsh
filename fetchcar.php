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

// SQL query to fetch car data from the database
$sql = "SELECT carname, model FROM tbl_cars";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Concatenate car name and model with a delimiter
        $car_model = $row["carname"] . ' - ' . $row["model"];
        echo '<option value="' . htmlspecialchars($car_model) . '">' . htmlspecialchars($car_model) . '</option>';
    }
} else {
    echo '<option value="">No cars found</option>';
}

// Close the database connection
$conn->close();
?>
