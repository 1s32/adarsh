<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'car');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if(isset($_POST['submit'])) {

    // Retrieve form data from session
    $fname = isset($_SESSION['fname']) ? $_SESSION['fname'] : '';
    $password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
    $mail = isset($_SESSION['mail']) ? $_SESSION['mail'] : '';
    $phn = isset($_SESSION['phn']) ? $_SESSION['phn'] : '';
    $otp = isset($_POST['otp']) ? $_POST['otp'] : '';

    // Check if the OTP is correct
    if ($_SESSION['otp'] == $otp) {
        // Prepare and execute the SQL queries
        $sql1 = "INSERT INTO tbl_login (email, password, Gcode) VALUES ('$mail', '$password', '$otp')";
        if ($conn->query($sql1) === TRUE) {
            $lid = $conn->insert_id;
            $_SESSION['lid'] = $lid;
            $sql2 = "INSERT INTO tbl_register (lid, name, phone) VALUES ('$lid', '$fname', '$phn')";
            if ($conn->query($sql2) === TRUE) {
                // Redirect to success page
                header("Location: signupsuccess.php");
                exit(); 
            } else {
                // Handle error for the second insert
                $_SESSION['error'] = "Error occurred while registering. Please try again.";
                header("Location: signuppage.php");
                exit();
            }
        } else {
            // Handle error for the first insert
            $_SESSION['error'] = "Error occurred while registering. Please try again.";
            header("Location: signuppage.php");
            exit();
        }
    } else {
        // Redirect with error message for invalid OTP
        $_SESSION['error'] = "Invalid OTP.";
     

    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sign Up</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2; /* Add a background color */
        }

        #video-background {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }

        .container {
            max-width: 400px;
            margin: 100px auto; /* Adjust margin for vertical centering */
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            position: relative;
            z-index: 1;
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
        <?php echo $_SESSION['otp']; ?>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        <?php
            if (isset($_SESSION['error'])) {
                echo 'Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "'.$_SESSION['error'].'",
                });';
                unset($_SESSION['error']);
            }
        ?>

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
</body>
</html>
