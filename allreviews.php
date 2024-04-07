<?php
// Database connection settings
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

// Fetch all reviews from the database
$sql = "SELECT l.email,f.feedback FROM tbl_userfeedbacks f,tbl_login l where l.lid=f.lid";
$result = $conn->query($sql);

// Initialize an array to store reviews
$reviews = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Reviews</title>
    <link rel="stylesheet" href="allreviewstyle.css">
</head>
<style>/* Reset some default styles */
*/* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px;
}

.reviews {
    max-width: 1000px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
}

.review {
    margin-bottom: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #f9f9f9;
    transition: transform 0.2s ease-in-out;
}

.review:hover {
    transform: scale(1.02);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
}

.review h3 {
    color: #333;
    font-size: 20px;
    margin-bottom: 10px;
}

.review p {
    color: #333; /* Change text color to improve readability */
    font-size: 16px;
    line-height: 1.5; /* Add line height for better spacing */
}

/* Adjust the link styles */
.back-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ffc107; /* Change background color to a brighter yellow */
    color: #333; /* Change text color to improve readability */
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.back-button:hover {
    background-color: #ffca28; /* Lighten the background color on hover */
}

</style>
<body>
    <header>
        <h1>Customer Reviews</h1>
    <font color="yellow"><a href="index.php" class="back-button">Back to Home</a></font>    
    </header>

    <section class="reviews">
        <?php foreach ($reviews as $review) : ?>
            <div class="review">
                <h3>Email: <?php echo htmlspecialchars($review['email']); ?></h3>
                <p>Review: <?php echo nl2br(htmlspecialchars($review['feedback'])); ?></p>
            </div>
        <?php endforeach; ?>
    </section>
</body>
</html>
