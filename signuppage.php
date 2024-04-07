<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$conn = new mysqli('localhost', 'root', '', 'car');
$signerror = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['register'])) {
    $a = $_POST['fname'];
    $b = $_POST['password'];
    $c = $_POST['email'];
    $d = $_POST['phone'];

    $check = "SELECT * FROM tbl_register b,tbl_login a WHERE b.phone='$d' or a.email='$c'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        
        $signerror = "Your account is already registered";
    } else {
        $_SESSION['fname']=$a;
        $_SESSION['password']=$b;
        $_SESSION['mail']=$c;
        $_SESSION['phn']=$d;
        
        // Generate and send OTP
        $randomOTP = mt_rand(100000, 999999);
        $_SESSION['otp']=$randomOTP;
       
        // Execute the insertion query for tbl_login
        // Send OTP to email
        // Load Composer's autoloader
        require 'vendor/autoload.php';

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
            $mail->setFrom('adarsh@gmail.com', 'adarsh');
            $mail->addAddress($c, $a);  // Add a recipient

            // Set email format to HTML
            $mail->Subject = 'OTP for Your Account Registration';
            $mail->Body = '
                <html>
                <body>
                    <h1>One-Time Password (OTP) for Account Registration</h1>
                    <p>Dear ' . $a . ',</p>
                    <p>Your OTP for account registration is: <strong>' . $randomOTP . '</strong></p>
                    <p>Please use this OTP to complete your registration process.</p>
                    <p>If you did not initiate this request, please ignore this email.</p>
                    <p>Thank you,<br>Team</p>
                </body>
                </html>';

            $mail->send();

            // Store user data in session


            // Redirect to OTP verification page
            header("Location: otp2.php");
            exit();
        } catch (Exception $e) {
            $signerror = "Error sending email. Please try again later.";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Car Sales and Services - Sign Up</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Hide scrollbars */
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
            margin: 4px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* To make sure it's on top of the video */
            z-index: 1; /* Place it above the video */
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"] {
            width: 95%;
            padding: 7px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 15px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus {
            border-color: #5F9EA0;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color:#FF0000;
            border: none;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #f00;
            text-align: center;
            margin-top: 10px; /* Add margin for spacing */
        }
    </style>
</head>
<body>
    <video autoplay muted loop id="video-background">
        <source src="mainloginvdo.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="" method="POST" onsubmit="return validateForm()">
            <label for="username">Name</label>
            <input type="text" id="username" name="fname" required oninput="validateName(this.value)">
            <div class="error-message" id="nameError"></div> <!-- Error message for name -->

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required oninput="validatePassword(this.value)">
            <div class="error-message" id="passwordError"></div> <!-- Error message for password -->

            <label for="repass">Re-enter Password</label>
            <input type="password" id="repass" name="repass" required oninput="validateReenteredPassword()">
            <div class="error-message" id="repassError"></div> <!-- Error message for re-entered password -->

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required oninput="validateEmail(this.value)">
            <div class="error-message" id="emailError"></div> <!-- Error message for email -->

            <label for="phone">Phone No</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]*" title="Please enter the phone number in the correct format (numbers only)" required oninput="validatePhoneNumber()">
            <div class="error-message" id="phoneError"></div> <!-- Error message for phone number -->

            <input type="submit" value="Sign Up" name="register">
            <div class="error-message" id="errorMessage"><?php echo $signerror ?></div>

            <p>Already a user? <a href="loginpage.php">Click here</a></p>
        </form>
    </div>

    <script>
        function validateName(name) {
            const nameRegex = /^[a-zA-Z]+$/; // Only alphabets allowed, no spaces
            const errorMessage = document.getElementById("nameError");

            if (!nameRegex.test(name)) {
                errorMessage.textContent = "Invalid format.";
                return false;
            } else {
                errorMessage.textContent = "";
                return true;
            }
        }

        function validatePassword(password) {
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$-+!%*?&])[A-Za-z\d@$!%*?&.]{6,}$/;

            const errorMessage = document.getElementById("passwordError");

            if (!passwordRegex.test(password)) {
                errorMessage.textContent = "Password should contain at least 6 characters with at least one uppercase, lowercase, special character, and number.";
                return false;
            } else {
                errorMessage.textContent = "";
                return true;
            }
        }

        function validateReenteredPassword() {
            const password = document.getElementById("password").value;
            const repass = document.getElementById("repass").value;
            const errorMessage = document.getElementById("repassError");

            if (password !== repass) {
                errorMessage.textContent = "Passwords do not match. Please re-enter the same password.";
                return false;
            } else {
                errorMessage.textContent = "";
                return true;
            }
        }

        function validateEmail(email) {
            const emailRegex = /^[^\d][^\s@]+@[^\s@]+\.[^\s@]+$/;
            const errorMessage = document.getElementById("emailError");

            if (!emailRegex.test(email)) {
                errorMessage.textContent = "Invalid email format.";
                return false;
            } else {
                errorMessage.textContent = "";
                return true;
            }
        }

        function validatePhoneNumber() {
            const phoneNumber = document.getElementById("phone").value;
            const phoneNumberRegex = /^(?!.*(.)\1{3})[7968]\d{9}$/;






            const errorMessage = document.getElementById("phoneError");

            if (!phoneNumberRegex.test(phoneNumber)) {
                errorMessage.textContent = "Please enter a valid phone number.";
                return false;
            } else {
                errorMessage.textContent = "";
                return true;
            }
        }

        function validateForm() {
            const name = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            const repass = document.getElementById("repass").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;

            // Run all validation functions
            const isNameValid = validateName(name);
            const isPasswordValid = validatePassword(password);
            const isReenteredPasswordValid = validateReenteredPassword();
            const isEmailValid = validateEmail(email);
            const isPhoneNumberValid = validatePhoneNumber();

            // Return true only if all validations pass
            return isNameValid && isPasswordValid && isReenteredPasswordValid && isEmailValid && isPhoneNumberValid;
        }
    </script>
</body>

</html>
