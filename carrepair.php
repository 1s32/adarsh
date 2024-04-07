<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$host = "localhost";
$username = "root";
$password = "";
$database = "car";

// Create a new connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $bdate = $_POST['bookingDate'];
    $a = $_SESSION['username'];
    $random_hour = mt_rand(9, 20); // Random hour between 9 and 20 (8 PM in 24-hour format)
    $random_minute = mt_rand(0, 59); // Random minute between 0 and 59
    $random_second = mt_rand(0, 59); // Random second between 0 and 59

    // Format the random time
    $random_time = sprintf('%02d:%02d:%02d', $random_hour, $random_minute, $random_second);

    // Insert booking into database
    $sql = "INSERT INTO tbl_repairservice(lid, bdate, btime)
            VALUES (
                (SELECT lid FROM tbl_login WHERE email = '$a'), '$bdate', '$random_time'
            );";
    if ($conn->query($sql) === TRUE) {
        // Send email to the user
        require 'vendor/autoload.php';

        // Create a PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
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
             // Add a recipient

           
            $mail->addAddress($_SESSION['username']); // User's email and name

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Tier Service Booking Confirmation';
            $mail->Body = "Dear " . $_SESSION['username'] . ",<br><br>Your tier service booking details are as follows:<br><br>Booking Date: $bdate<br>Time to Come: $random_time<br><br>Thank you for booking our service.";

            // Send email
            $mail->send();
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<body><script>
            Swal.fire({
                title: "success!",
                text: "Booking Done.",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script></body>';
    
            // Redirect after successful booking
            header("Location: mybookings.php");
            exit();
        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error inserting booking into database: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include'navbarforuser.php' ?>
    <title>Service Booking</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
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

        label {
            font-weight: bold;
        }

        input[type="date"], input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Service Booking</h1>
     
        <form id="bookingForm" method="post">
            <label for="bookingDate">Booking Date:</label>
            <input type="date" id="bookingDate" name="bookingDate" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+3 days')); ?>" required>
            <span class="error-message" id="dateError"></span>
            <input type="submit" name="submit" value="Book Now">
        </form>
    </div>

   
</body>
</html>
