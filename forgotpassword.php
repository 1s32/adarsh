<?php
// Start or resume the session
session_start();

// Reset session variables as needed
$_SESSION = array(); // Reset all session variables

// Destroy the session
session_destroy();

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';


$conn = new mysqli('localhost', 'root', '', 'car');
if (isset($_POST['submit'])) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $randomOTP = mt_rand(100000, 999999);
        $sql = "SELECT email from tbl_login where email='$email'; ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $updateSql = "UPDATE tbl_login SET Gcode = $randomOTP WHERE email = '$email';";

            if ($conn->query($updateSql)) {
                $_SESSION['forgot_password_email'] = $email;

                // Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->SMTPDebug = 0;  // Enable verbose debug output
                    $mail->isSMTP();       // Send using SMTP
                    $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
                    $mail->SMTPAuth = true;  // Enable SMTP authentication
                    $mail->Username = 'adarsh918g@gmail.com';  // SMTP username
                    $mail->Password = 'tmci mckp oixj qpcj';  // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable explicit TLS encryption
                    $mail->Port = 587;  // Use 587 for STARTTLS, or 465 for implicit TLS (SMTPS)
                    $mail->isHTML(true);

                    // Recipients
                    $mail->setFrom('anandupganesh@gmail.com', 'adarsh');
                    $mail->addAddress($email, 'Anandu');  // Add a recipient

                    // Set email format to HTML
                    $mail->Subject = 'Password Reset OTP for Your Account';
                    $mail->Body = '
                    <html>
                    <body>
                        <h1>Password Reset OTP</h1>

                        <p>Dear [User],</p>

                        <p>We have received a request to reset the password for your account associated with the email address <strong>[acecarrentals@email.com]</strong>. To proceed with the password reset, please use the following One-Time Password (OTP):</p>

                        <h2>Your OTP: <span style="color: #007bff;">' . $randomOTP . '</span></h2>

                        <p>Please enter this OTP on the password reset page to complete the process. If you did not initiate this request, please ignore this email. Ensure the security of your account by not sharing this OTP with anyone.</p>

                        <p>If you have any questions or concerns, please contact our support team.</p>

                        <p>Thank you, <br>Ace Car Rentals</p>
                    </body>
                    </html>';

                    $mail->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                header("Location: otp.php");

            } else {
                echo "Error: " . $updateSql . "<br>" . $conn->error;
            }

        } else {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Forgot Password</title>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>

            </body>
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Email is not registered!",
                    width: 350,
                    height: 60,
                });

            </script>
            </html>
            <?php
        }


    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ace Car Rentals - Forgot Password</title>
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
    <!-- External Stylesheets -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<video autoplay muted loop id="video-background">
        <source src="mainloginvdo.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
<div class="container">
    <a class="navbar-brand" href=""><span style="color: green;">Adarsh</span> <span>Car sales and service</span></a>

    <header>Forgot Password</header>
    <form action="#" method="post" class="form">
        <div class="input-box">
            <label class="form-check-label" for="exampleCheck1">Enter your registered Email Address of your account!</label>
            <br>
            <input type="email" placeholder="Enter email" id="email" name="email" />
            <div class="error-message" id="email-error"></div>
        </div>

        <!-- Error message div -->
        <div id="errorMessage"></div>

        <div class="d-flex align-items-center justify-content-between mb-3">

        </div>
        <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Send OTP</button>
    </form>

    <!-- Back button -->
    <a href="loginpage.php" class="back-btn">&#8249; Back</a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.form');

        function showError(input, message, errorId) {
            document.getElementById(errorId).textContent = message;
        }

        function showSuccess(errorId) {
            document.getElementById(errorId).textContent = '';
        }

        function validateField(input, regex, message, errorId) {
            const value = input.value.trim();
            const isValid = regex.test(value);
            isValid ? showSuccess(errorId) : showError(input, message, errorId);
            return isValid;
        }

        function validateForm() {
            const emailValid = validateField(document.getElementById('email'), /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, 'Please enter a valid email address.', 'email-error');

            return emailValid;
        }

        form.addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            } else {
                // Validation passed, submit the form
                // Optional: You can add any additional logic here before submitting the form
            }
        });

        form.addEventListener('input', function (event) {
            const inputElement = event.target;
            switch (inputElement.name) {
                case 'email':
                    validateField(inputElement, /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/, 'Invalid email address.', 'email-error');
                    break;
                default:
                    break;
            }
        });
    });
</script>
</body>

</html>
