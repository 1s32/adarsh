<?php
session_start();

if (!isset($_SESSION['forgot_password_email'])) {
    header("Location: forgotpassword.php");
}

$email = $_SESSION['forgot_password_email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
$conn = new mysqli('localhost', 'root', '', 'car');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {

    if (isset($_POST['otp'])) {
        $otp = $_POST['otp'];
        $checkSql = "SELECT * FROM tbl_login WHERE email = '$email';";
        $result = $conn->query($checkSql);

        // Check if the query was successful
        if ($result) {
            // Fetch the data from the result set
            while ($row = $result->fetch_assoc()) {
                // Output the email to the console
                // Note: The correct syntax is console.log, not console . log
                $otpCheck = $row['Gcode'];

                echo "<script>console.log('" . $row['Gcode'] . "');</script>";
            }
        } else {
            // Handle the case where the query was not successful
            echo "<script>alert('Query failed: " . $conn->error . "');</script>";
        }
        if ($otpCheck == $otp) {
             header("Location: resetpassword.php");
            exit();
        }else{
            echo"<script>alert('Incorrect OTP');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
 
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Hide scrollbars */
            background-color: #f2f2f2; /* Add a background color */
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 100px;
            position: relative; /* To make sure it's on top of the video */
            z-index: 1; /* Place it above the video */
        }

        header {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form {
            margin-bottom: 20px;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .input-box input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .error-message {
            color: red; /* Set the error message color to red */
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            background-color: #FF0000;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .back-btn {
            color: #5F9EA0;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        .navbar-brand {
            color: green;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            display: block;
            text-align: center;
            margin-bottom: 20px;
        }
        <!-- video -->
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        overflow: hidden; /* Hide scrollbars */
        background-color: #f2f2f2; /* Add a background color */
    }

    #video-background {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100%; /* Set the video to cover the entire viewport */
        min-height: 100%;
        z-index: -1; /* Place it behind everything else */
    }

    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 40px;
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 50px;
        margin-top: 100px;
        position: relative; /* To make sure it's on top of the video */
        z-index: 1; /* Place it above the video */
    }

    header {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .form {
        margin-bottom: 20px;
    }

    .input-box {
        margin-bottom: 20px;
    }

    .input-box label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .input-box input[type="email"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    .error-message {
        color: red; /* Set the error message color to red */
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: none;
        background-color: #FF0000;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    .back-btn {
        color: #5F9EA0;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .back-btn:hover {
        text-decoration: underline;
    }

    .navbar-brand {
        color: green;
        text-decoration: none;
        font-size: 24px;
        font-weight: bold;
        display: block;
        text-align: center;
        margin-bottom: 20px;
    }

    </style>
</head>

<body>
<video autoplay muted loop id="video-background">
        <source src="mainloginvdo.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <a class="navbar-brand" href=""><span style="color: green;">Adarsh</span> <span>Car sales and service</span></a>

        <header>OTP</header>
        <form action="#" method="post" onsubmit="return validateForm()" class="form">
            <div class="input-box">
                <label class="form-check-label" for="exampleCheck1" style="color: black;">
                    Enter the OTP received in your registered Email Address!
                </label>
                <br>
                <input type="number" placeholder="Enter OTP" id="otp" name="otp" oninput="validateOtp()" />
                <div class="error-message" id="otp-error"></div>
            </div>

            <!-- Countdown timer -->
            <div id="countdown" style="color: #007bff;"></div>

            <!-- Error message div -->
            <div id="errorMessage"></div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="form-check">

                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Submit OTP</button>
        </form>

        <!-- Back button -->
        <a href="./loginpage.php" class="back-btn">&#8249; Back</a>
    </div>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener for live validation on input
        document.getElementById('otp').addEventListener('input', function() {
            validateOtp();
        });
    });

    function validateOtp() {
        // Get OTP input value and error message element
        var otpInput = document.getElementById('otp').value.trim();
        var errorMessageDiv = document.getElementById('otp-error');

        // Use a regex to match exactly 6 digits
        var otpRegex = /^\d{6}$/;

        if (!otpRegex.test(otpInput)) {
            // Display error message for invalid OTP
            errorMessageDiv.textContent = 'Enter a valid 6-digit OTP';
        } else {
            // Clear error message for valid OTP
            errorMessageDiv.textContent = '';
        }
    }

    function validateForm() {
        // Get OTP input value and error message element
        var otpInput = document.getElementById('otp').value.trim();
        var errorMessageDiv = document.getElementById('otp-error');

        // Use a regex to match exactly 6 digits
        var otpRegex = /^\d{6}$/;

        if (!otpRegex.test(otpInput)) {
            // Display error message for invalid OTP
            errorMessageDiv.textContent = 'Enter a valid 6-digit OTP';
            // Prevent form submission
            return false;
        }

        // Form is valid, allow submission
        return true;
    }
</script>
