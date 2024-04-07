<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <style>
        /* Reset some default styles */
        body, h2, p {
            margin: 0;
            padding: 0;
        }

        /* Center the car details vertically */
        .car-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align content to the left */
            justify-content: center;
            height: 100vh;
            padding: 20px; /* Add some padding to push content to the left */
        }

        /* Style the car image container */
        .car-image-container {
            width: 300px; /* Adjust the width as needed */
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            overflow: hidden; /* Clip the image within the container */
        }

        /* Style the car image */
        .car-details img {
            max-width: 100%;
            height: auto;
            display: block; /* Remove the default inline behavior of the image */
        }

        /* Style the car name */
        .car-details h2 {
            font-size: 24px;
            color: #333;
        }
    </style>
</head>
<body>
<div class="car-details">
    <a href="stylecar2.php">
        <div class="car-image-container">
            <img src="seltos11.webp" alt="Car Image">
        </div>
        <h2>Seltos</h2>
    </a>
</div>
</body>
</html>

