<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: loginpage.php");
    exit();
}

if (
    isset($_POST['car_id']) &&
    isset($_POST['car_name']) &&
    isset($_POST['model_name']) &&
    isset($_POST['model_year']) &&
    isset($_POST['price']) &&
    isset($_FILES['image']['name']) // Check if image file is uploaded
) {
    // Retrieve form data
    $car_id = $_POST['car_id'];
    $car_name = $_POST['car_name'];
    $model_name = $_POST['model_name'];
    $model_year_input = $_POST['model_year'];
    $milege = $_POST['milege'];
    $price = $_POST['price'];
    $km = $_POST['km'];

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

    // Handle image upload
    $image_path = ''; // Initialize image path

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        // Define the directory where uploaded images will be stored
        $upload_dir = 'up/';

        // Create the directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Generate a unique filename for the image
        $image_filename = uniqid() . '_' . $_FILES['image']['name'];

        // Define the full path to store the uploaded image
        $target_path = $upload_dir . $image_filename;

        // Move the uploaded file to the target path
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $image_path = $target_path; // Set the image path
        } else {
            echo "Error uploading the image.";
            exit;
        }
    } else {
        echo "Image file is required.";
        exit;
    }

    // SQL query to update data in the "tbl_cars" table
    $sql = "UPDATE tbl_cars SET carname='$car_name', model='$model_name', model_year='$model_year_input', price=$price, image='$image_path', km='$km', milege='$milege' WHERE carname='$car_name' or model='$model_name'";

    if ($conn->query($sql) === TRUE) {
        // Car updated successfully
       
        // Add JavaScript to display SweetAlert
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Car updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        $response = [
            'success' => false,
            'message' => 'Error: ' . $sql . "<br>" . $conn->error
        ];
        echo json_encode($response);
        // Add JavaScript to display SweetAlert
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error updating car: " . $conn->error . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
}

/* Apply styles to the form headings */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Apply styles to form labels */
label {
    font-weight: bold;
    color: #555;
}

/* Apply styles to form inputs */
.form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
}

/* Apply styles to file input */
.form-control-file {
    margin-top: 10px;
}

/* Apply styles to submit button */
.btn-primary {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'navbar.php'; ?> 
    ?>
    <title>Update Car Details</title>
    <!-- Add your custom CSS file here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Car Details</h2>
        <form id="updateCarForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="car_selection">Select Car</label>
                <select class="form-control" id="car_selection" name="car_id" required>
                    <?php
                        // Include the code to fetch car data and populate options
                        include 'fetchcar.php';
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="car_name">Car Name</label>
                <input type="text" class="form-control" id="car_name" name="car_name" required>
            </div>
            <div class="form-group">
                <label for="model_name">Model Name</label>
                <input type="text" class="form-control" id="model_name" name="model_name" required>
            </div>
            <div class="form-group">
                <label for="model_year">Model Year</label>
                <input type="number" class="form-control" id="model_year" name="model_year" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="km">Kilometers Traveled</label>
                <input type="number" class="form-control" id="km" name="km" required>
            </div>
            <div class="form-group">
                <label for="milege">Milege in km</label>
                <input type="number" class="form-control" id="milege" name="milege" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Update Car</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Function to validate car name
        function validateCarName(carName) {
            return /^[a-zA-Z\s]{2,}$/.test(carName);
        }

        // Function to validate model name
        function validateModelName(modelName) {
            return /^[a-zA-Z0-9\s]{2,}$/.test(modelName);
        }

        // Function to validate model year
        function validateModelYear(modelYear) {
            return /^\d{4}$/.test(modelYear);
        }

        // Function to validate price
        function validatePrice(price) {
            return /^\d+$/.test(price);
        }

        // Function to validate kilometers
        function validateKm(km) {
            return /^\d+$/.test(km);
        }

        // Function to validate mileage
        function validateMileage(mileage) {
            return /^\d+$/.test(mileage);
        }

        // Function to validate image file
        function validateImage(filename) {
            return /\.(jpg|jpeg|png)$/i.test(filename);
        }

        // Function to display error message
        function showError(input, message) {
            // Check if error message already exists
            if (!$(input).next('.error').length) {
                // Add error class to form-group
                $(input).closest('.form-group').addClass('has-error');
                // Show error message in red color
                $(input).after('<span class="error" style="color: red;">' + message + '</span>');
            }
        }

        // Function to clear error message
        function clearError(input) {
            // Remove error class from form-group
            $(input).closest('.form-group').removeClass('has-error');
            // Remove error message
            $(input).siblings('.error').remove();
        }

        // Function to validate form fields on submission
        $('#updateCarForm').submit(function(event) {
            // Reset any previous errors
            $('.error').remove();

            // Fetch form data
            var carName = $('#car_name').val();
            var modelName = $('#model_name').val();
            var modelYear = $('#model_year').val();
            var price = $('#price').val();
            var km = $('#km').val();
            var mileage = $('#milege').val();
            var image = $('#image').val();

            // Validate each field
            if (!validateCarName(carName)) {
                showError($('#car_name'), 'invalid');
                event.preventDefault();
            }

            if (!validateModelName(modelName)) {
                showError($('#model_name'), 'invalid');
                event.preventDefault();
            }

            if (!validateModelYear(modelYear)) {
                showError($('#model_year'), 'invalid');
                event.preventDefault();
            }

            if (!validatePrice(price)) {
                showError($('#price'), 'invalid');
                event.preventDefault();
            }

            if (!validateKm(km)) {
                showError($('#km'), 'invalid.');
                event.preventDefault();
            }

            if (!validateMileage(mileage)) {
                showError($('#milege'), 'invalid');
                event.preventDefault();
            }

            if (!validateImage(image)) {
                showError($('#image'), 'invalid');
                event.preventDefault();
            }
        });

        // Real-time validation for car name field
        $('#car_name').keyup(function() {
            var carName = $(this).val();
            if (!validateCarName(carName)) {
                showError($(this), 'invalid');
            } else {
                clearError($(this));
            }
        });

        // Real-time validation for model name field
        $('#model_name').keyup(function() {
            var modelName = $(this).val();
            if (!validateModelName(modelName)) {
                showError($(this), 'invalid');
            } else {
                clearError($(this));
            }
        });

        // Real-time validation for model year field
        $('#model_year').keyup(function() {
            var modelYear = $(this).val();
            if (!validateModelYear(modelYear)) {
                showError($(this), 'invalid.');
            } else {
                clearError($(this));
            }
        });

        // Real-time validation for price field
        $('#price').keyup(function() {
            var price = $(this).val();
            if (!validatePrice(price)) {
                showError($(this), 'invalid.');
            } else {
                clearError($(this));
            }
        });

        // Real-time validation for kilometers field
        $('#km').keyup(function() {
            var km = $(this).val();
            if (!validateKm(km)) {
                showError($(this), 'invalid.');
            } else {
                clearError($(this));
            }
        });

        // Real-time validation for mileage field
        $('#milege').keyup(function() {
            var mileage = $(this).val();
            if (!validateMileage(mileage)) {
                showError($(this), 'invalid');
            } else {
                clearError($(this));
            }
        });

        // Real-time validation for image file
        $('#image').change(function() {
            var filename = $(this).val();
            if (!validateImage(filename)) {
                showError($(this), 'invalid.');
            } else {
                clearError($(this));
            }
        });
    });
</script>

</body>
</html>
    <!-- Add your custom JavaScript file here -->

