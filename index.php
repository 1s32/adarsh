<?php
// Start the session (if not started already)
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="car.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Sales & Service</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <style>/* Reset some default styles */
body, h1, h2, h3, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f2f2f2;
}
/* ... (Previous styles) */

nav a {
    color: #0074a9 ;
    text-decoration: none;
    font-weight: bold; /* Make the font bold */
    font-size: 16px; /* Set the font size */
    transition: color 0.3s, font-size 0.3s; /* Add transition effects */
}

/* Change link color and font size on hover */
nav a:hover {
    text-decoration: none;
    color: red ; /* Adjust color on hover */
    font-size: 18px; /* Increase font size on hover */
}

nav a {
    color:blue;
    text-decoration: none;
    font-weight: bold; /* Make the font bold */
    font-size: 16px; /* Set the font size */
    padding: 10px 20px; /* Add padding to create a button-like appearance */
    border-radius: 5px; /* Add rounded corners */
    transition: background-color 0.3s, color 0.3s; /* Add transition effects */
}

/* Change background color and text color on hover */
nav a:hover {
    text-decoration: none;
    background-color: #0074a9; /* Background color on hover */
    color: #fff; /* Text color on hover */
}

/* Add an underline animation on hover */
nav a::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #0074a9; /* Color of the underline */
    visibility: hidden;
    transform: scaleX(0);
    transition: all 0.3s ease-in-out 0s;
}

nav a:hover::before {
    visibility: visible;
    transform: scaleX(1);
}

/* ... (Other existing styles) */


header {
    background-color: ; 
    padding: 10px;
    float: right;
}

nav ul {
    list-style: none;
}

nav li {
    display: inline-block;
    margin-right: 180px;
}

nav a {
    color: #fff;
    text-decoration: none;
}

nav a {
    color: red;
    text-decoration: none;
    position: relative;
    transition: color 0.3s; /* Add transition effect on color change */
}

/* ... (Previous styles) */

nav a {
    color: #0074a9;
    text-decoration: none;
    position: relative;
    transition: color 0.3s; /* Add transition effect on color change */
}

/* Change link color on hover */
nav a:hover {
    text-decoration: none;
    color: #0074a9; /* Adjust color on hover */
    background-color: #f2f2f2; /* Add background color on hover */
    transform: translateY(-3px); /* Add a subtle upward shift on hover */
}

/* Add an underline animation on hover */
nav a::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #0074a9; /* Color of the underline */
    visibility: hidden;
    transform: scaleX(0);
    transition: all 0.3s ease-in-out 0s;
}

nav a:hover::before {
    visibility: visible;
    transform: scaleX(1);
}

/* ... (Other existing styles) */



.hero {
    background-image:url('carmain.gif'); 
    background-size:cover;
    background-position:center;
    color:#ff4646;
    text-align:center;
    padding:250px;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero h1 {
    font-size: 48px;
    margin-bottom: 20px;
}

.hero p {
    font-size: 18px;
    margin-bottom: 30px;
}

.btn {
    display: inline-block;
    background-color: #e74c3c;
    color: #ffffff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
}

.btn:hover {
    background-color: #c0392b;
}

.featured-cars {
    padding: 40px 20px;
    background-color: #fff;
}

.featured-cars h2 {
    font-size: 32px;
    margin-bottom: 20px;
}

.car-listings {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.car-item {
    max-width: 250px;
    padding: 20px;
    margin: 20px;
    background-color: #f9f9f9;
    border-radius: 4px;
    text-align: center;
    transition: background-color 0.3s, box-shadow 0.3s;
}

.car-item:hover {
    background-color: #e0e0e0; /* Change the background color on hover */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a subtle box-shadow on hover */
}


.car-item img {
    max-width: 100%;
}

.car-item h3 {
    font-size: 24px;
    margin-top: 10px;
}

.car-item p {
    font-size: 18px;
    margin-top: 10px;
}

.popular-brands {
    padding: 40px 20px;
    background-color: #f2f2f2;
}

.popular-brands h2 {
    font-size: 32px;
    margin-bottom: 20px;
}

.brand-list {
    display: flex;
    justify-content: space-around;
}

.brand-item {
    text-align: center;
}

.brand-item img {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}

.brand-item p {
    font-size: 18px;
}

.services {
    background-color: #f5f5f5; /* Background color */
    padding: 20px; /* Add some padding to the section */
}

.services h2 {
    font-size: 24px; /* Adjust the heading font size */
    margin-bottom: 20px; /* Add spacing below the heading */
}

.services ul {
    list-style: none; /* Remove default list bullets */
    padding: 0; /* Remove default list padding */
}

.services li {
    font-size: 18px; /* Adjust the list item font size */
    margin-bottom: 10px; /* Add spacing between list items */
}

.book-now-button {
    display: inline-block;
    padding: 10px 20px; /* Adjust the button padding */
    background-color: #0074a9; /* Button background color */
    color: #fff; /* Button text color */
    text-decoration: none; /* Remove underlines from the link */
    border-radius: 5px; /* Add rounded corners */
    transition: background-color 0.3s; /* Add a smooth transition effect */
}

.book-now-button:hover {
    background-color: #005682; /* Change the background color on hover */
}


.contact {
    padding: 40px 20px;
    background-color: #f2f2f2;
}

.contact h2 {
    font-size: 32px;
    margin-bottom: 20px;
}

.contact p {
    font-size: 18px;
    margin-bottom: 10px;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
}
.fa {  
  padding: 20px;  
text-align: center;  
  margin: 5px 2px;  
  font-size: 30px;  
  width: 50px;  
}  
.fa-facebook {  
  background: #3B5998;  
  color: white;  
}  
.fa-twitter {  
  background: #55ACEE;  
  color: white;  
}  
.fa-pinterest {  
  background: #cb2027;  
  color: white;  
}  
.fa-linkedin {  
  background: #007bb5;  
  color: white;  
}  
.fa-instagram {  
  background: #125688;  
  color: white;  
}  
.fa-youtube {  
  background: #bb0000;  
  color: white;  
}  
.fa-google {  
  background: #dd4b39;  
  color: white;  
}  
.fa-snapchat-ghost {  
  background: #fffc00;  
  color: white;  
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;  
}  
.fa-skype {  
  background: #00aff0;  
  color: white;  
}  
.fa:hover {  
    opacity: 0.9;  
}
.book-now-button {
    background-color: #081524; /* Blue background color */
    color: #fff; /* White text color */
    padding: 10px 20px; /* Padding for better appearance */
    border: none; /* Remove button border */
    border-radius: 5px; /* Add rounded corners */
    cursor: pointer; 
}
</style>
</head>
<body >  
    <header>
        <nav>
            <ul>
              
                <li><a href="logout.php">Log Out</a></li> <!-- Add a logout link -->
             
                <li><a href="#contact">Contact</a></li>
                <li><a href="reviews.php">Give feedbacks</a></li>
                <li><a href="loginpage.php">Log in</a></li>
                <li><a href="signuppage.php">Sign Up</a></li>
                
                <li>
             <a href="userprofile.php"> 
                Profile
             </a>
                </li>
                
                
            </ul>
        </nav>
</header>
    <main>
        <section class="hero">
     
            <div class="hero-content">
                


                <h1>Welcome to Adarsh Car Sales & Service</h1>
                <p>Find your dream car and get the best service for your vehicle.</p>
                <a href="viewcaruser.php" class="btn">Cars</a>
                <a href="service1.php" class="btn">Services</a>
            </div>
        </section>

        <section class="featured-cars">
            <h2>Featured Cars</h2>
            <div class="car-listings">
                <div class="car-item">
                    <a href="">
                    <img src="nioshome.jpg" alt="">

                    </a>
                    <h3>Nios i10</h3>
                </div>
                <div class="car-item">
                    <a href="">
                    <img src="651259670808a_swift1.jpeg" alt="">
                    </a>
                    <h3>Maruthi Swift</h3>
                </div>
                <div class="car-item">
                    <a href="">
                        <img src="Kia Seltos 2023 Facelift 1677504205338.jpg" alt="Car 3">
                    </a>
                    <h3>Kia Seltos</h3>
                </div>
                <div class="car-item">
                    <a href="">
                        <img src="innovahome.jpg" alt="Car 4">
                    </a>
                    <h3>Innova Crysta</h3>
                </div>
            </div>
        </section>
        <section class="popular-brands">
    <h2>Popular Brands</h2>
    <div class="brand-list">
        <a href="" class="brand-item">
            <img src="hyundai.png" alt="HYUNDAI">
        </a>
        <a href="" class="brand-item">
            <img src="suzuki.png" alt="SUZUKI">
        </a>
        <a href="" class="brand-item">
            <img src="kialogo.svg" alt="Kia">
        </a>
        <a href="" class="brand-item">
            <img src="toyota.png" alt="Toyota">
        </a>
    </div>
</section>
        <section class="services">
            <h2>Our Services</h2>
            <ul>
                <li>Car Repairs</li>
                <li>Car Detailing</li>
                <li>Tire Services</li>
                <li>Oil Change</li>
                <a href="service1.php" class="book-now-button">Book Services </a><br></br>
            </ul>
        </section>

        <section class="contact" id="contact">
            <h2>Contact Us</h2>
            <p>If you have any questions or inquiries, feel free to contact us:</p>
            <p>Phone: 8590771875</p>
            <p>Kanjirapally,edakkadu building,Kottayam</p>
            <p>686512</p>
           
            <p>Email: <a href="mailto:ajcarsalesandservice@gmail.com">adarshcarsalesandservice@gmail.com</a></p>
         
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Adarsh Car Sales & Service. All rights reserved.</p>
    </footer>

    <script>
        // Smooth scroll function
        function smoothScroll(target) {
            const element = document.querySelector(target);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Attach click event to the "Contact" link
        const contactLink = document.querySelector('a[href="#contact"]');
        if (contactLink) {
            contactLink.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default anchor behavior
                smoothScroll("#contact"); // Scroll to the contact section
            });
        }
    </script>

</body>
</html>

