<?php
if (isset($_POST['del'])) {
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

    // Get car_id from the form
    $carname = $_POST['name'];
    $model = $_POST['model'];
    $year = $_POST['year'];

    // SQL query to delete the car record
    $sql = "update tbl_cars set status='0'where carname='$carname'and model='$model' and model_year='$year'";

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
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
                        title: "Car Deleted Successfully",
                        width: 350,
                        height: 60,
                    }).then(function () {
                        window.location.href = 'Adminhomepage1.php'; // Redirect after showing the message
                    });
                </script>
            </body>
            </html>
            <?php
            exit(); // Ensure nothing else is processed after showing the message
        }else {
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
  icon: "error",
  title: "Oops...",
  text: "Deletion not successfull",

}).then(function () {
                        window.location.href = 'Adminhomepage1.php'; // Redirect after showing the message
                    });
                </script>
            </body>
            </html>
            <?php
            exit(); 
           
        }
    } else {
        echo "Error deleting car: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Car</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.1.5/sweetalert2.min.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form container */
        .form-container {
            width: 90%; /* Adjusted width */
            max-width: 500px; /* Adjusted max-width */
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Form header */
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            color: #007bff;
        }

        /* Form fields */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit button */
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group input[type="submit"]:hover {
            background-color: #c82333;
        }

        /* Error message */
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <?php include "navbar.php"; ?>
        <div class="form-header">
            <h1>Delete Car</h1>
        </div>
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Car Name:</label>
                <input type="text" id="name" name="name" >
            </div>
            <div class="form-group">
                <label for="model">Car Model:</label>
                <input type="text" id="model" name="model" >
            </div>
            <div class="form-group">
                <label for="year">Model Year:</label>
                <input type="text" id="year" name="year" >
            </div>
            <div class="form-group">
                <input type="submit" name="del" value="Delete Car">
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.1.5/sweetalert2.min.js"></script>
    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var model = document.getElementById("model").value;
            var year = document.getElementById("year").value;

            if (name.trim() == "" || model.trim() == "" || year.trim() == "") {
                swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "All fields are required!"
                });
                return false;
            }
            return true;
        }
    </script>
</body>
</html>