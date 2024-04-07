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
    ?>