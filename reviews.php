<?php
session_start(); // Start a new or resume the existing session

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION['username'])) {
    header("location: loginpage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_SESSION['username']; // Get the username from the session

    $review = $_POST["review"];

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

    // Prepare and execute an SQL INSERT statement to store the review in the database
    $sql="INSERT INTO tbl_userfeedbacks (lid, feedback)
    VALUES (
        (SELECT lid FROM tbl_login WHERE email = '$name'), '$review'
  
    );";
    if($conn->query($sql) == TRUE){
    
          // Car added successfully, display SweetAlert
          echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<body><script>
        Swal.fire({
            title: "Success!",
            text: "Thankyou for  your review.",
            icon: "success",
            confirmButtonText: "OK"
        });

    </script></body>'; 
      
    //$stmt->bind_param( $name, $email, $review);



    // Close the database connection

    $conn->close();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Sales and Services</title>
    <link rel="stylesheet" href="reviewstyle.css">
</head>
<body>
    <header>
        <h1>Give your valuable reviews</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="allreviews.php">Customer Reviews</a></li>
        </ul>
    </nav>

    <section class="content">
        <h2>please give your valuable reviews..</h2>
    

        <form action="reviews.php" method="post">
            <label for="review">Review:</label><br>
            <textarea id="review" name="review" rows="4" cols="50" required></textarea><br><br>

            <input type="submit" value="Submit Review">
        </form>
        </div>
    </section>
</body>
</html>
