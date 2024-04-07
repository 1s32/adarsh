

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
    $newName = $_POST['new_name'];
    $newPhone = $_POST['new_phone'];

    $updateSql = "UPDATE tbl_register r,tbl_login l SET r.name='$newName',r.phone='$newPhone' WHERE l.email='{$_SESSION['username']}'";

    if ($conn->query($updateSql) === TRUE) {
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
                    title: "updated successfully",
                    width: 350,
                    height: 60,
                }).then(function () {
                    window.location.href = 'userprofile.php'; // Redirect after showing the message
                });
            </script>
        </body>
        </html>
        <?php
        exit(); 
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve user information from the database
$sql = "SELECT r.name, r.phone FROM tbl_register r,tbl_login l WHERE l.lid=r.lid and l.email='{$_SESSION['username']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first (and only) row
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $phone = $row['phone'];
 
} else {
    echo "User not found";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
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

        .btn:hover {
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
        <?php include 'navbarforuser.php'; ?>
        <h1>Edit Profile</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="editProfileForm">
        <div class="form-group">
    <label for="new_name">Name:</label>
    <input type="text" id="new_name" name="new_name" value="<?php echo $name; ?>" required>
    <span id="nameError" class="error-message"></span>
</div>

            <div class="form-group">
                <label for="new_phone">Phone:</label>
                <input type="text" id="new_phone" name="new_phone" value="<?php echo $phone; ?>" required>
                <span id="phoneError" class="error-message"></span>
            </div>
            <input type="submit" value="Update Profile" class="btn">
        </form>
        <a href="userprofile.php" class="btn">Back to Profile</a>
    </div>

    <script>
    const newName = document.getElementById('new_name');
    const newPhone = document.getElementById('new_phone');
    const editProfileForm = document.getElementById('editProfileForm');
    const phoneError = document.getElementById('phoneError');
    const nameError = document.getElementById('nameError');

    function validatePhone() {
    const phoneRegex = /^(?:[6-9])\d{9}$/; // Phone number pattern
    const repeatedDigitsRegex = /(\d)\1{2}/g; // Regular expression to check for repeated digits

    if (!phoneRegex.test(newPhone.value)) {
        phoneError.textContent = 'Invalid format';
    } else if (/\W/.test(newPhone.value) || /\s/.test(newPhone.value)) {
        phoneError.textContent = 'Special characters or whitespaces are not allowed';
    } else if (repeatedDigitsRegex.test(newPhone.value)) {
        phoneError.textContent = 'invalid format';
    } else {
        phoneError.textContent = '';
    }
}

    function validateName() {
    const nameRegex = /^[a-zA-Z]+$/; // Allow only letters without spaces
    if (!nameRegex.test(newName.value)) {
        nameError.textContent = 'Name must contain only letters';
    } else {
        nameError.textContent = '';
    }
}


    newPhone.addEventListener('input', validatePhone);
    newName.addEventListener('input', validateName);

    editProfileForm.addEventListener('submit', function(event) {
        validatePhone();
        validateName();

        if (phoneError.textContent || nameError.textContent) {
            event.preventDefault();
        }
    });
</script>

</body>

</html>
