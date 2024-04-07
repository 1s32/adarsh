<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'car');
$login_message = "";

if (isset($_POST['login'])) {
    $a = $_POST['username'];
    $b = $_POST['password'];
    

    // Check for admin login
    $admin_query = "SELECT * FROM tbl_login WHERE email='$a' AND password='$b' AND role='admin'";


    $admin_result = $conn->query($admin_query);

    if ($admin_result->num_rows > 0) {
        $_SESSION['username'] = $a;
        $_SESSION['email']=$a;
    

        header("Location: Adminhomepage1.php");
        exit();
    }
$block="select * from tbl_login where status='blocked'";
$result=$conn->query($block);
if($result->num_rows>0){
  header("Location:blockedbyadmin.php");
}
    // Check for user login
    $user_query = "SELECT * FROM tbl_login WHERE email='$a' AND password='$b' AND role='user' and status='unblocked'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $_SESSION['username'] = $a;
        header("Location: index.php");
        exit();
    }
else{
    // If neither admin nor user login succeeds, show error message
    $login_message = "Invalid username or password";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Car Sales and Services - Sign Up</title>

  <style>
    
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
    .loading-message {
      display: none;
      text-align: center;
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

    h1 {
      text-align: center;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    

    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
    }

    .form-group input[type="submit"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: none;
      background-color: #FF0000;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
      background-color: #45a049;
    }

    .form-group .error-message {
      color: #f00;
    }
  </style>
</head>
<script>
    function showLoading() {
      document.getElementById("loading-message").style.display = "block";
    }
    function showLoading() {
      document.getElementById("loading-message").style.display = "block";
      setTimeout(function() {
        document.getElementById("login-form").submit();
      }, 3000); // 3 seconds delay
    }
    if (window.history && window.history.pushState) {
        window.history.pushState('forward', null, './#forward');
        window.addEventListener('popstate', function(event) {
            // Redirect to the login page
            window.location.href = 'loginpage.php';
        });
    }
  </script>

<body>
  <video autoplay muted loop id="video-background">
    <source src="mainloginvdo.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="container">
    <h1>Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <input type="submit" name="login" value="Log in"><br><br>        <div id="loading-message" class="loading-message">Logging in...</div>

      </div>
      <div class="form-group">
        New user? <a href="signuppage.php">Click Here</a>
       <br>
<center> <br><a href="forgotpassword.php">Forgot Password</a></center>
      </div>
      <div class="form-group error-message">
        <?php echo $login_message; ?>
      </div>
    </form>
  </div>
</body>
</html>
