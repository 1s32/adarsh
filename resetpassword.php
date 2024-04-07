<?php
session_start();

if (!isset($_SESSION['forgot_password_email'])) {
    header("Location: forgotpassword.php");
    exit();
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
    if (isset($_POST['newpassword']) && isset($_POST['confirmpassword'])) {
        $newpassword = $_POST['newpassword'];
        $confirmpassword = ($_POST['confirmpassword']);

        if ($newpassword == $confirmpassword) {
            $sql = "UPDATE tbl_login SET password = '$newpassword' WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result == TRUE) {
                // Password changed successfully
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Password Changed</title>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Password changed successfully",
                            width: 350,
                            height: 60,
                        }).then(function () {
                            window.location.href = 'loginpage.php'; // Redirect after showing the message
                        });
                    </script>
                </body>
                </html>
                <?php
                exit(); // Ensure nothing else is processed after showing the message
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: forgot_password.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Passwords do not match";
            header("Location: forgot_password.php");
            exit();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ace Car Rentals - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
   
    <style>
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
        .error-message {
            color: red
        }
    </style>
</head>

<body>
<video autoplay muted loop id="video-background">
        <source src="mainloginvdo.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <a class="navbar-brand" href=""><span style="color: green;">Adarsh</span> <span>Car Sales and service</span></a>

        <header>Reset Password</header>
        <form action="#" method="post" onsubmit="return validateForm()" class="form">
            <label for="newPassword" style="color:black;">Enter new password</label>
            <!-- Added onsubmit attribute -->
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="newpassword" id="newPassword"
                    placeholder="newpassword" oninput="validatePassword(this.value)">
                
                <!-- Error message for new password -->
                <div id="password-error" class="error-message"></div>
            </div>
            <label for="confirmPassword" style="color:black;">Confirm new password</label>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="confirmpassword" id="confirmPassword"
                    placeholder="confirmpassword" onblur="validateConfirmPassword()">
               
                <!-- Error message for confirm password -->
                <div id="confirm-password-error" class="error-message"></div>
            </div>

            <!-- Countdown timer -->
            <div id="countdown" style="color: #007bff;"></div>

            <!-- Error message div -->
            <div id="errorMessage"></div>

            <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Submit </button>
        </form>

        <!-- Back button -->
        <a href="./login.php" class="back-btn">&#8249; Back</a>
    </div>
</body>

</html>

<script>
    function validateForm() {
        var newPassword = document.getElementById("newPassword").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        // Validate new password
        if (!validatePassword(newPassword)) {
            return false;
        }

        // Validate confirm password
        if (newPassword !== confirmPassword) {
            document.getElementById("confirm-password-error").innerHTML = "Passwords do not match.";
            return false;
        }

        return true;
    }

    function validatePassword(password) {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&.]{6,}$/;

        if (!passwordRegex.test(password)) {
            document.getElementById("password-error").innerHTML = "Password should contain at least 6 characters with at least one uppercase, lowercase, special character, and number.";
            return false;
        } else {
            document.getElementById("password-error").innerHTML = "";
            return true;
        }
    }

    function validateConfirmPassword() {
        document.getElementById("confirm-password-error").innerHTML = "";
    }
</script>








        <!-- Sign In End -->
    </div>

    <!-- JavaScript code for real-time password validation -->
    <!-- Add this script inside your HTML file, preferably at the end of the body tag -->


    <!-- JavaScript Libraries -->
   </script>

    <!-- Template Javascript -->
 
</body>

</html>