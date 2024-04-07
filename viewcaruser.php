<?php
session_start();

// Check if the session variable 'username' is not set
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("location: loginpage.php");
    exit(); // Stop further execution
}
?>
<body>
<style>
    .view-details-btn {
        padding: 8px 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .view-details-btn:hover {
        background-color: #0056b3;
    }

    .search-result-item {
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 10px;
        }

        .search-result-item img {
            max-width: 100%;
            max-height: 150px;
            border-radius: 8px;
        }

        .search-result-item h2 {
            font-size: 18px;
            margin-top: 10px;
        }

        .search-result-item p {
            margin-top: 5px;
        }
</style>

</body>
<?php
// Check if the user is logged in (you can define a login check as per your requirements)
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or perform any other action
    header("Location: loginpage.php"); // Replace "newlogin.php" with the actual login page
    exit();
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

// SQL query to fetch all data from the "car2" table
$sql = "SELECT * FROM tbl_cars where status='1'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Cars</title>
    <style>
        /* Same CSS styles as in the view cars page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .user-info {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info form {
            margin-bottom: 20px; /* Add margin to separate it from other content */
            margin-right: 20px;
        }

        .user-info input[type="text"] {
            padding: 5px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .user-info input[type="submit"], .btn-back-to-home {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .user-info input[type="submit"]:hover, .btn-back-to-home:hover {
            background-color: #0056b3;
        }

        .car-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 columns with equal width */
            gap: 20px; /* Gap between grid items */
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
            max-width: 100%; /* Set a maximum width for the images */
            max-height: 200px; /* Set a maximum height for the images */
        }

        .car-item h2 {
            font-size: 18px;
            margin-top: 10px;
        }

        .user-info {
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between; /* Adjusted to distribute space evenly */
        padding: 0 20px; /* Added padding to match the layout */
    }

    .user-info form {
        margin-bottom: 20px; /* Add margin to separate it from other content */
        margin-right: 20px;
    }

    .user-info input[type="text"] {
        padding: 5px;
        width: 200px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .user-info input[type="submit"],
    .btn-back-to-home {
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .user-info input[type="submit"]:hover,
    .btn-back-to-home:hover {
        background-color: #0056b3;
    }

    .car-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* 2 columns with equal width */
        gap: 20px; /* Gap between grid items */
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
        max-width: 100%; /* Set a maximum width for the images */
        max-height: 200px; /* Set a maximum height for the images */
    }

    .car-item h2 {
        font-size: 18px;
        margin-top: 10px;
    }
       .user-info {
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between; /* Adjusted to distribute space evenly */
        padding: 0 20px; /* Added padding to match the layout */
    }

    .user-info form {
        margin-bottom: 20px; /* Add margin to separate it from other content */
        margin-right: 20px;
    }

    .user-info input[type="text"] {
        padding: 5px;
        width: 200px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .user-info input[type="submit"],
    .user-info a {
        padding: 8px 16px;
        border-radius: 5px;
        background-color: transparent; /* Transparent background */
        color: #007bff; /* Blue color */
        cursor: pointer;
        text-decoration: none;
        transition: color 0.3s; /* Smooth transition for color change */
    }



    .car-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* 2 columns with equal width */
        gap: 20px; /* Gap between grid items */
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
        max-width: 100%; /* Set a maximum width for the images */
        max-height: 200px; /* Set a maximum height for the images */
    }

    .car-item h2 {
        font-size: 18px;
        margin-top: 10px;
    }
    /* Same CSS styles as before */

    .user-info {
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between; /* Adjusted to distribute space evenly */
        padding: 0 20px; /* Added padding to match the layout */
    }

    .user-info form {
        margin-bottom: 20px; /* Add margin to separate it from other content */
        margin-right: 20px;
    }

    .user-info input[type="text"] {
        padding: 5px;
        width: 200px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .user-info input[type="submit"] {
        padding: 8px 16px;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s;
    }


    .user-info a {
        padding: 8px 0; /* Adjusted padding */
        color: yellow; /* Blue color */
        cursor: pointer;
        text-decoration: none;
        transition: color 0.3s; /* Smooth transition for color change */
    }

 

    .car-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* 2 columns with equal width */
        gap: 20px; /* Gap between grid items */
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
        max-width: 100%; /* Set a maximum width for the images */
        max-height: 200px; /* Set a maximum height for the images */
    }

    .car-item h2 {
        font-size: 18px;
        margin-top: 10px;
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

        .view-details-btn {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .view-details-btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script>
  $(document).ready(function(){
        // Function to handle keyup event in the search input
        $("#livesearch").keyup(function(){
            var input = $(this).val();
            if(input !== "") {
                $.ajax({
                    url: "search.php",
                    method: "POST",
                    data: {input: input},
                    success: function(data) {
                        // Clear existing search results
                        $(".car-grid").empty();
                        // Append car boxes from search results
                        $(".car-grid").append(data);
                    }
                });
            } else {
                // If search input is empty, clear the search results
                $(".car-grid").empty();
            }
            // Enable or disable the search button based on input value
            $("input[name='search']").prop("disabled", input === "");
        });

        // Disable the search button initially
        $("input[name='search']").prop("disabled", true);
    });
</script>
<body>
<header>
    <h1>Search Cars</h1>
    <div class="user-info">
        <form action="search.php" method="POST"> <!-- Assuming 'search.php' is the page where you handle the search -->
            <input type="text" id="livesearch" name="input" placeholder="Search cars...">
            <input type="submit" name="search" value="Search">
        </form>
        <a href="index.php">Back to Home</a> <!-- Back to home link styled as plain text -->
    </div>

</header>

<section class="car-grid">
<?php
        // Display search results
        if(isset($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div id ="searchresult" class="car-box">';
                echo '<div class="car-item">';
                
                echo '<img src="' . $row['image'] . '" width="300" alt="' . $row['carname'] . '">';
        
                echo '<h2>' . $row['carname'] . ' ' . $row['model'] . '</h2>';
                echo '<p>MODEL YEAR: ' . $row['model_year'] . '</p>';
                echo '<p>PRICE: ' . $row['price'] . '</p>';

                echo '<div class="buttons">';

                // Add a styled button to view details
                echo '<form action="car_details.php" method="GET">';
                echo '<input type="hidden" name="carid" value="' . $row['carid'] . '">';
                echo '<a href="bookings.php?carid=' . $row['carid'] . '" class="view-details-btn">View Details</a>';
                echo '</form>';

                // Add wishlist button
               // Add wishlist button
               echo '<form action="" method="GET">';
               echo '<input type="hidden" name="carid" value="' . $row['carid'] . '">';
        
               echo '<input type="submit" name="wishlist" class="wishlist-btn" value="Add to Wishlist">';
               echo '</form>';
               
                
                echo '</form>';

                echo '</div>'; // End of .buttons div

                echo '</div>'; // End of .car-item div
                echo '</div>'; // End of .car-box div
            }
        } else {
            echo "No cars found.";
        }
        ?>


</script>
</section>

</body>


</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
if(isset($_GET['wishlist'])) {
    $a = $_GET['carid'];
    $b = $_SESSION['username'];

    // Check if the item already exists in the wishlist for the current user
    $check_query = "SELECT * FROM tbl_wishlist WHERE cid='$a' AND lid=(SELECT lid FROM tbl_login WHERE email='$b')";
    
    // For debugging purposes, echo out the generated SQL query


    $check_result = $conn->query($check_query);
    
    // Echo out the number of rows returned by the query for debugging
  

    if($check_result->num_rows > 0) {
        // Item already exists in the wishlist for the current user, show SweetAlert warning message
        echo '<script>
            Swal.fire({
                title: "Warning!",
                text: "This car is already in your wishlist.",
                icon: "warning",
                confirmButtonText: "OK"
            });
        </script>';
    } else {
        // Item does not exist in the wishlist for the current user, insert it
        $insert_query = "INSERT INTO tbl_wishlist (cid, lid) VALUES ('$a', (SELECT lid FROM tbl_login WHERE email='$b'))";

        if ($conn->query($insert_query) === TRUE) {
            // Query executed successfully, show SweetAlert success message
            echo '<script>
                Swal.fire({
                    title: "Success!",
                    text: "Car added to wishlist successfully!",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            </script>';
        } else {
            // Query failed, show SweetAlert error message
            echo '<script>
                Swal.fire({
                    title: "Error!",
                    text: "Failed to add car to wishlist.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            </script>';
        }
    }
}
?>
