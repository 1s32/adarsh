<?php
session_start();

// Check if the session variable 'username' is not set
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("location: loginpage.php");
    exit(); // Stop further execution
}

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

// Fetch wishlist items for the current user
$username = $_SESSION['username'];
$sql = "SELECT c.* FROM tbl_wishlist w JOIN tbl_cars c ON w.cid = c.carid WHERE w.lid = (SELECT lid FROM tbl_login WHERE email = '$username')";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <style>
        /* Same CSS styles as in the view cars page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .car-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 20px;
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
            background-color: #ffc107; /* Yellow color */
            color: #333; /* Dark text color */
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-top: 10px; /* Add some spacing between the buttons */
        }

        .wishlist-btn:hover {
            background-color: #ffca28; /* Lighter yellow on hover */
        }

        /* Adjustments to layout for user-friendly alignment */
        .car-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .car-item p {
            margin: 5px 0; /* Reduce margin between paragraphs */
        }

        .car-item .buttons {
            margin-top: 10px; /* Add spacing between buttons */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .car-item .buttons a,
        .car-item .buttons button {
            margin-bottom: 5px; /* Add spacing between buttons */
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

    <!-- SweetAlert script link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
  <?php include'navbarforuser.php'; ?>
   

<section class="car-grid">
<?php
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div id="searchresult" class="car-box">';
        echo '<div class="car-item">';
        
        echo '<img src="' . $row['image'] . '" width="300" alt="' . $row['carname'] . '">';
        echo '<h2>' . $row['carname'] . ' ' . $row['model'] . '</h2>';
        echo '<p>MODEL YEAR: ' . $row['model_year'] . '</p>';
        echo '<p>PRICE: ' . $row['price'] . '</p>';
     
        echo"<br>";
        // View details button
        echo '<form action="car_details.php" method="GET">';
        echo '<input type="hidden" name="carid" value="' . $row['carid'] . '">';
        echo '<a href="bookings.php?carid=' . $row['carid'] . '" class="view-details-btn">View Details</a>';
        echo '</form>';

     
        echo '<div class="buttons">';
        echo '<form action="wishlist.php" method="POST">'; // Changed action to wishlist.php
        echo '<input type="hidden" name="carid" value="' . $row['carid'] . '">';
        echo '<input type="submit" name="remove_wishlist" class="wishlist-btn" value="Remove from Wishlist">';
        echo '</form>';
        echo '</div>'; // End of .buttons div
        
        echo '</div>'; // End of .car-item div
        echo '</div>'; // End of .car-box div
    }
} else {
    echo "No items in the wishlist.";
}

?>

</section>

</body>
</html>

<?php
if(isset($_POST['remove_wishlist'])) {
    $a=$_POST['carid']; // Change $_GET to $_POST
    $sql="DELETE FROM tbl_wishlist WHERE cid='$a'";
    if($conn->query($sql) === TRUE)
    {
        // Item deleted from the wishlist, show SweetAlert success message
       // Item already exists in the wishlist, show SweetAlert warning message
       echo '<script>
       Swal.fire({
           title: "Success",
           text: "This car removed from your wishlist.",
           icon: "success",
           confirmButtonText: "OK"
       });
   </script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close(); // Close the connection
?>
