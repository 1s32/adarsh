<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginpage.php"); // Redirect to login page if user is not logged in
    exit();
}

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'car');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$a=$_SESSION['username'];
// Retrieve user information from the database
$sql = "select r.name,r.phone,l.email,l.password from tbl_login l join tbl_register r on l.lid=r.lid and l.email='$a'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first (and only) row
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $pass = $row['password'];
 // Assuming password is stored securely
} else {
    echo "User not found";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            font-weight: bold;
        }

        .profile-info p {
            margin: 5px 0;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<nav>
        <ul>
            <li><a href="index.php">Home</a></li>
     
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>View Profile</h1>
        <div class="profile-info">
            <label for="name">Name:</label>
            <p><?php echo $name; ?></p>
        </div>
        <div class="profile-info">
            <label for="email">Email:</label>
            <p><?php echo $email; ?></p>
        </div>
        <div class="profile-info">
            <label for="phone">Phone:</label>
            <p><?php echo $phone; ?></p>
        </div>
        <div class="profile-info">
            <label for="password">Password:</label>
            <p><?php echo $pass; ?></p>
        </div>
        
        <a href="updateprofile.php" class="btn">Edit Profile</a>
        <a href="updatepass.php" class="btn">Update Password</a>
        <a href="wishlist.php" class="btn">My Wishlist</a>
        <a href="mybookings.php" class="btn">Service Bookings</a>
  
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>

</html>
