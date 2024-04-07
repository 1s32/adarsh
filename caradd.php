<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: loginpage.php");
    exit();
}

if (
    isset($_POST['car_name']) &&
    isset($_POST['model_year']) &&
    isset($_POST['price']) &&
    isset($_FILES['image']['name']) // Check if image file is uploaded
) {
    // Retrieve form data
    $car_name = $_POST['car_name'];
    $model_name=$_POST['model_name'];
    $model_year_input = $_POST['model_year'];
    $milege=$_POST['milege'];
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

    // SQL query to insert data into the "car2" table
    $sql = "INSERT INTO tbl_cars ( carname,model, model_year, price, image, km,milege) VALUES ( '$car_name','$model_name', '$model_year_input', $price, '$image_path', '$km','$milege')";

    if ($conn->query($sql) === TRUE) {
        // Car added successfully, display SweetAlert
        echo '<script>
            window.onload = function() {
                Swal.fire({
                    title: "Success!",
                    text: "Added Successfully.",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            };
        </script>'; // Ensure nothing else is processed after showing the message
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Add Car</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Form container */
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        /* Form header */
        .form-header h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Form fields */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus,
        .form-group input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit button */
        .form-group .submit-btn {
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

        .form-group .submit-btn:hover {
            background-color: #0056b3;
        }

        /* Error message */
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .submit-error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
        <?php    
include "navbar.php";
?>

            <h1>Add a New Car</h1>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" id="addCarForm">
           
            <div class="form-group">
                <label for="car_name">Car Name:</label>
                <input type="text" id="car_name" name="car_name" required>
            </div>
            <div class="form-group">
                <label for="car_name">Model Name:</label>
                <input type="text" id="car_model" name="model_name" required>
                <span class="error-message" id="modelNameError"></span>
            </div>
            <!-- Date input removed -->
            <div class="form-group">
    <label for="model_year">Model Year:</label>
    <input type="number" id="model_year" name="model_year" required>
    <span class="error-message" id="modelYearError"></span>
</div>  <div class="form-group">
    <label for="km">Kilometers Traveled:</label>
    <input type="number" id="km" name="km" required>
    <span class="error-message" id="kmError"></span>
</div>
<div class="form-group">
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" required>
    <span class="error-message" id="priceError"></span>
</div>
            <div class="form-group">
                <label for="image">Image (Upload Image File):</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                <span class="error-message" id="imageError"></span>
            </div>
        
            <div class="form-group">
    <label for="milege">Milege in km:</label>
    <input type="number" id="milege" name="milege" required>
    <span class="error-message" id="milegeError"></span>
</div>
            <div class="form-group">
                <input type="submit" value="Add Car" name="add" class="submit-btn">
            </div>
        </form>
    </div>

    <script>
    // Live validation for Model Name field
    document.getElementById('car_model').addEventListener('input', function(event) {
        var modelNameInput = event.target;
        var modelNameValue = modelNameInput.value.trim();
        var modelNameError = document.getElementById('modelNameError');
        var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

        if (modelNameValue.length === 0) {
            modelNameError.textContent = 'Model Name is required';
        } else if (specialCharacters.test(modelNameValue)) {
            modelNameError.textContent = 'Model Name should not contain special characters';
        } else {
            modelNameError.textContent = '';
        }
    });

    // Live validation for Price field
    document.getElementById('price').addEventListener('input', function(event) {
        var priceInput = event.target;
        var priceValue = priceInput.value.trim();
        var priceError = document.getElementById('priceError');
        var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

        if (specialCharacters.test(priceValue)) {
            priceError.textContent = 'Price should not contain special characters';
            priceInput.value = ''; // Clear the input
        } else {
            priceError.textContent = '';
        }
    });

    // Live validation for Mileage field
    document.getElementById('milege').addEventListener('input', function(event) {
        var milegeInput = event.target;
        var milegeValue = milegeInput.value.trim();
        var milegeError = document.getElementById('milegeError');
        var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

        if (specialCharacters.test(milegeValue)) {
            milegeError.textContent = 'Milege should not contain special characters';
            milegeInput.value = ''; // Clear the input
        } else {
            milegeError.textContent = '';
        }
    });
    document.getElementById('model_year').addEventListener('input', function(event) {
        var modelYearInput = event.target;
        var modelYearValue = modelYearInput.value.trim();
        var modelYearError = document.getElementById('modelYearError');
        var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

        if (specialCharacters.test(modelYearValue)) {
            modelYearError.textContent = 'Model Year should not contain special characters';
            modelYearInput.value = ''; // Clear the input
        } else {
            modelYearError.textContent = '';
        }
    });
    // Live validation for Kilometers Traveled field
    document.getElementById('km').addEventListener('input', function(event) {
        var kmInput = event.target;
        var kmValue = kmInput.value.trim();
        var kmError = document.getElementById('kmError');
        var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

        if (specialCharacters.test(kmValue)) {
            kmError.textContent = 'Kilometers Traveled should not contain special characters';
            kmInput.value = ''; // Clear the input
        } else {
            kmError.textContent = '';
        }
    });

    // Live validation for Image field
    document.getElementById('image').addEventListener('change', function(event) {
        var fileInput = event.target;
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (!allowedExtensions.test(filePath)) {
            document.getElementById('imageError').innerText = 'Only JPG, JPEG, and PNG files are allowed.';
            fileInput.value = ''; // Clear the file input
        } else {
            document.getElementById('imageError').innerText = '';
        }
    });
</script>

</body>
</html>
