<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
        }

        .success-message {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .success-message:hover {
            transform: scale(1.05);
        }

        h1 {
            font-size: 36px;
        }

        p {
            font-size: 18px;
        }

        .login-button {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-align: center;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s, box-shadow 0.3s;
    box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.7); /* Added a subtle black outline */
}

.login-button:hover {
    background-color: #45a049;
    box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.7); /* Enlarge the black outline on hover */
}


    </style>
</head>
<body>
    <div class="container">
        <div class="success-message">
            <h1>Sign Up Successful!</h1>
            <p>Thank you for signing up. You can now log in to your account.</p>
            <button class="login-button" onclick="redirectToLoginPage()">Log In</button>
        </div>
    </div>

    <script>
        function redirectToLoginPage() {
            // You can replace this URL with the actual login page URL
            window.location.href = "loginpage.php";
        }
    </script>
</body>
</html>
