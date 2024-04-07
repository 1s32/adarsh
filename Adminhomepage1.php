<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    overflow: hidden; /* Hide scroll bars */
}

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        nav {
            background-color: #333;
            padding: 10px;
            border-radius: 0 0 8px 8px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            margin: 0 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #555;
        }

        .admin-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 20px;
            justify-content: center;
            align-items: center;
        }

        .admin-links li {
            text-align: center;
        }

        .admin-links a {
            background-color: #3ca9ff;
            color: #fff;
            padding: 1rem 2rem;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            transition: background-color 0.3s;
            display: block;
        }

        .admin-links a:hover {
            background-color: #555;
        }

        footer {
            text-align: center;
            padding: 1rem 0;
            background-color: #333;
            color: #fff;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, Admin!</h1>
    </header>
    <nav>
        <ul>
            <li><a href="caradd.php">Add Cars</a></li>
            <li><a href="removecardata.php">Remove Cars</a></li>
            <li><a href="">User Info</a></li>
            <li><a href="viewcar.php">Car Info</a></li>
            <li><a href="feedbackview.php">Feedback</a></li>
            <li><a href="adduser.php">Add User</a></li>
            <li><a href="blockuser.php">Block User</a></li>
            <li><a href="editcars.php">Update Car Details</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="c1.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="c2.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="c3.jpg" style="width:100%">
        </div>
    </div>

   
</body>
<script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            slides[slideIndex-1].style.display = "block";  
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>
</html>
