<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginpage.php"); // Redirect to login page if user is not logged in
    exit();
}

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'car');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    $sql="select password from tbl_login where password='$currentPassword'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
        $bql = "UPDATE tbl_login SET password='$newPassword' WHERE email='{$_SESSION['username']}'";

        if($conn->query($bql)==true)
        {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<body><script>
        Swal.fire({
            title: "Success!",
            text: "password changed.",
            icon: "success",
            confirmButtonText: "OK"
        });

    </script></body>';

        }
    }
    else
    {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<body><script>
        Swal.fire({
            title: "Warning!",
            text: "Pass not found in db.",
            icon: "warning",
            confirmButtonText: "OK"
        });
    </script></body>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px; /* Add space between navigation and form */
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px; /* Add space between navigation and form */
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
    <nav>
        <a href="userprofile.php">Back to Profile</a>
    </nav>
        <h2>Update Password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="updatePasswordForm">
     
            <label for="current_password">Current Password:</label><br>
            <input type="password" id="current_password" name="current_password" required><br>
            <span id="currentPasswordError" class="error-message"></span>

            <label for="new_password">New Password:</label><br>
            <input type="password" id="new_password" name="new_password" required><br>
            <span id="newPasswordError" class="error-message"></span>

            <label for="confirm_new_password">Confirm New Password:</label><br>
            <input type="password" id="confirm_new_password" name="confirm_new_password" required><br>
            <span id="confirmNewPasswordError" class="error-message"></span>

            <input type="submit" value="Update Password">
        </form>
            <script>
    const currentPassword = document.getElementById('current_password');
    const newPassword = document.getElementById('new_password');
    const confirmNewPassword = document.getElementById('confirm_new_password');
    const updatePasswordForm = document.getElementById('updatePasswordForm');
    const currentPasswordError = document.getElementById('currentPasswordError');
    const newPasswordError = document.getElementById('newPasswordError');
    const confirmNewPasswordError = document.getElementById('confirmNewPasswordError');

    function validateCurrentPassword() {
        // Validate current password if needed
    }

    function validateNewPassword() {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{6,}$/;
        if (!passwordRegex.test(newPassword.value)) {
            newPasswordError.textContent = 'Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 6 characters long';
        } else {
            newPasswordError.textContent = '';
        }
    }

    function validateConfirmNewPassword() {
        if (confirmNewPassword.value !== newPassword.value) {
            confirmNewPasswordError.textContent = 'Passwords do not match';
        } else {
            confirmNewPasswordError.textContent = '';
        }
    }

    newPassword.addEventListener('input', validateNewPassword);
    confirmNewPassword.addEventListener('input', validateConfirmNewPassword);

    updatePasswordForm.addEventListener('submit', function(event) {
        validateCurrentPassword();
        validateNewPassword();
        validateConfirmNewPassword();

        if (newPasswordError.textContent || confirmNewPasswordError.textContent) {
            event.preventDefault();
        }
    });
</script>

</body>
</html>
