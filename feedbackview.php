<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: loginpage.php");
    exit();
}

// Database connection parameters
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "car";

// Create a new connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve feedback from the "userfeedback" table
$sql = "SELECT f.lid,f.feedback,l.email FROM tbl_userfeedbacks f,tbl_login l where f.lid=l.lid and l.role !='admin'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      body {
    font-family: Arial, sans-serif;
    width: 100vw;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 14px;
    font-family: "Helvetica Neue", Arial, Verdana, sans-serif;
    background: url('5480.jpg') no-repeat center center fixed;
    background-size: cover;
    z-index: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    max-height: 80vh; /* Example height, adjust as needed */
    overflow-y: scroll; /* Enable vertical scrolling within the container */
}

h1 {
    text-align: center;
    color: #333;
}

.feedback {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
}

.feedback p {
    margin: 0;
}

    </style>
</head>
<body>
<?php    
include "navbar.php";
?>

    <div class="container">
        <h1>Feedbacks Received From Customers</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='feedback'>";
                echo "<p><strong>User: </strong>" . $row['lid'] . "</p>";
                echo "<p><strong>Email: </strong>" . $row['email'] . "</p>";
                echo "<p><strong>Feedback: </strong>" . $row['feedback'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No feedback available.</p>";
        }
        ?>
    </div>
</body>
</html>