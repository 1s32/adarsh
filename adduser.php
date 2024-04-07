<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'car');
$signerror = "";

if (isset($_POST['adduser'])) {
    $a = $_POST['name'];
    $b = $_POST['password'];
    $c = $_POST['email'];
    $d = $_POST['phone'];

    $check = "SELECT * FROM tbl_register WHERE phone='$d'";
    
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        $signerror = "Your account is already registered";
    } else {
        $_SESSION['name'] = $a;
        $_SESSION['username'] = $c;
        $sql = "INSERT INTO tbl_register (name, phone) VALUES ('$a', '$d')";
        $sql2 = "INSERT INTO tbl_login (email, password) VALUES ('$c', '$b')";

        if ($conn->query($sql) === true && $conn->query($sql2) === true) {
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
                    title: "User Added Successfully",
                    width: 350,
                    height: 60,
                })
            </script>
            </body>
            </html>
            <?php
            
            exit();
        } else {
            $signerror = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Video background */
        #video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Ensure video is behind other content */
        }

        /* Form container */
        .form-container {
            width: 400px; /* Set width of the form */
            margin: auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1; /* Ensure form appears above the video background */
        }

        /* Form header */
        .form-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333; /* Dark text color */
        }

        /* Form fields */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555; /* Medium dark text color */
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
            color: #333; /* Dark text color */
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="tel"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Error message */
        .error-message {
            color: red;
            margin-top: 5px;
        }

        /* Submit button */
        .submit-btn {
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

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php    
include "navbar.php";
?>

    <div class="form-container">
        
        <h1>Add User</h1>
        <form action="" method="POST" id="userForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required oninput="validateName()">
                <span class="error-message" id="nameError"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required oninput="validateEmail()">
                <span class="error-message" id="emailError"></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required oninput="validatePhone()">
                <span class="error-message" id="phoneError"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required oninput="validatePassword()">
                <span class="error-message" id="passwordError"></span>
            </div>
            <div class="form-group">
                <label for="repassword">Re-enter Password:</label>
                <input type="password" id="repassword" name="repassword" required oninput="validatePasswordMatch()">
                <span class="error-message" id="passwordMatchError"></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Adduser" name="adduser" class="submit-btn" id="submitButton">
                
                <?php echo $signerror; ?>
            </div>
        </form>
    </div>

    <script>
     function validateName() {
    var nameInput = document.getElementById("name");
    var nameError = document.getElementById("nameError");
    var nameValue = nameInput.value.trim();

    if (/\d/.test(nameValue)) {
        nameError.textContent = "Name cannot include numbers.";
        document.getElementById("submitButton").disabled = true; // Disable submit button
    } else {
        nameError.textContent = "";
        document.getElementById("submitButton").disabled = false; // Enable submit button
    }
}

        function validateEmail() {
    var emailInput = document.getElementById("email");
    var emailError = document.getElementById("emailError");
    var emailValue = emailInput.value.trim();

    // Regular expression for email validation
    var emailPattern = /^[^\d][^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(emailValue)) {
        emailError.textContent = "Invalid email format.";
        document.getElementById("submitButton").disabled = true; // Disable submit button
    } else {
        emailError.textContent = "";
        document.getElementById("submitButton").disabled = false; // Enable submit button
    }
}

        function validatePhone() {
            var phoneInput = document.getElementById("phone");
            var phoneError = document.getElementById("phoneError");
            var phoneValue = phoneInput.value.trim();

            // Regular expression for phone number validation
            var phonePattern = /^\d{10}$/;

            if (!phonePattern.test(phoneValue)) {
                phoneError.textContent = "Invalid phone number format.";
                document.getElementById("submitButton").disabled = true; // Disable submit button
            } else {
                phoneError.textContent = "";
                document.getElementById("submitButton").disabled = false; // Enable submit button
            }
        }

        function validatePassword() {
    var passwordInput = document.getElementById("password");
    var passwordError = document.getElementById("passwordError");
    var passwordValue = passwordInput.value.trim();

    // Regular expression for password validation
    var passwordPattern = /^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*()_+]).{6,}$/;

    if (!passwordPattern.test(passwordValue)) {
        passwordError.textContent = "Password must contain at least one digit, one letter, one special character, and be at least 6 characters long.";
        document.getElementById("submitButton").disabled = true; // Disable submit button
    } else {
        passwordError.textContent = "";
        document.getElementById("submitButton").disabled = false; // Enable submit button
    }
}

        function validatePasswordMatch() {
            var passwordInput = document.getElementById("password");
            var repasswordInput = document.getElementById("repassword");
            var passwordMatchError = document.getElementById("passwordMatchError");

            if (passwordInput.value !== repasswordInput.value) {
                passwordMatchError.textContent = "Passwords do not match.";
                document.getElementById("submitButton").disabled = true; // Disable submit button
            } else {
                passwordMatchError.textContent = "";
                document.getElementById("submitButton").disabled = false; // Enable submit button
            }
        }
    </script>
</body>
</html>
