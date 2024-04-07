<?php
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

// Fetch user information


// Fetch service booking information
$service_query = "SELECT * FROM tbl_oilchange";
$service_result = $conn->query($service_query);

// Fetch test drive booking information


// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <title>View Data</title>
</head>
<body>
    <h1>View Data</h1>
    <div class="container">
        <h2>User Information</h2>
        <table>
            <tr>
                
                <th>Username</th>
                <th>Email</th>
                <th>Phone No</th>
                <!-- Add more columns as needed -->
            </tr>
            <?php
            if ($user_result->num_rows > 0) {
                while ($row = $user_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phoneno'] . "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No user information available.</td></tr>";
            }
            ?>
        </table>

        <h2>Service Booking Information</h2>
        <table>
        <tr>
                
                <th>Bookid</th>
                <th>Email</th>
                <th>CarNo</th>
                <th>serviceid</th>
                <th>servicedate</th>
            </tr>
            <?php
            if ($service_result->num_rows > 0) {
                while ($row = $service_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['sbookid'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['car_No'] . "</td>";
                    echo "<td>" . $row['serviceid'] . "</td>";
                    echo "<td>" . $row['servicedate'] . "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No user information available.</td></tr>";
            }
            ?>
        </table>

        <h2>Test Drive Booking Information</h2>
        <table>
        <table>
        <tr>
                
                <th>Bookid</th>
                <th>Email</th>
                <th>Car_Id</th>
                <th>Testdrivedate</th>
            </tr>
            <?php
            if ($testdrive_result->num_rows > 0) {
                while ($row = $testdrive_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bookid'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['testdate'] . "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No user information available.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
