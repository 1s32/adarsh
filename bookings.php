<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: loginpage.php");
    exit();
}



$car_id = $_GET['carid'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_cars WHERE carid = '$car_id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    echo "Car not found.";
    exit();
}

$car = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cars</title>
    <link rel="stylesheet" href="style22.css"> <!-- Link to your CSS file -->
    <style>
        /* Basic CSS for the navbar */
        .navbar {
            background-color: blue; /* Changed background color to blue */
            overflow: hidden;
            text-align: center; /* Centering the navbar contents */
        }

        .navbar a {
            display: inline-block; /* Making the links appear horizontally */
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="Hometest.php">Home</a>
        <a href="viewcaruser.php">Back</a>
    </div>
    <title>Book Car</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .car-details {
            margin-bottom: 20px;
        }

        .car-details img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
        }

        .car-info {
            margin-top: 20px;
            text-align: left;
        }

        .car-info p {
            margin: 10px 0;
            font-size: 18px;
        }

        .booking-form {
            text-align: center;
        }

        .booking-form form {
            max-width: 400px;
            margin: 0 auto;
        }

        .booking-form input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .booking-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> <?php echo $car['carname'] . ' ' . $car['model']; ?></h1>
        
        <div class="car-details">
            <img src="<?php echo $car['image']; ?>" alt="<?php echo $car['carname'] . ' ' . $car['model']; ?>">
        </div>
        
        <div class="car-info">
            <h2>Car Details</h2>
            <p><strong>Car Name:</strong> <?php echo $car['carname']; ?></p>
            <p><strong>Model:</strong> <?php echo $car['model']; ?></p>
            <p><strong>Model Year:</strong> <?php echo $car['model_year']; ?></p>
            <p><strong>Price:</strong> $<?php echo $car['price']; ?></p>
            <p><strong>Kilometers Traveled:</strong> <?php echo $car['km']; ?></p>
            <p><strong>Mileage:</strong> <?php echo $car['milege']; ?> km</p>
            <!-- Add any additional details here -->
            <p>This <?php echo $car['carname']; ?> model is a reliable choice for those seeking a dependable second-hand vehicle. With its <?php echo $car['model_year']; ?> model year, it offers a balance of performance and affordability. Having traveled <?php echo $car['km']; ?> kilometers, it has proven its durability on the road. Its <?php echo $car['milege']; ?> km mileage ensures fuel efficiency, making it an economical option for daily commutes. Don't miss out on this opportunity to own a quality used car!</p>

        </div>
        
        <div class="booking-form">
         
                <input type="submit" value="Book Now">
            </form>
        </div>
    </div>
</body>
</html>
