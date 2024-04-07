<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Creator</title>
    <link rel="stylesheet" href="">
    <style>
        /* Reset some default styles */
body, h1, h2, p {
    margin: 0;
    padding: 0;
}

/* Style the body */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    line-height: 1.6;
}

/* Style the header */
header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
}

/* Style the h1 in the header */
header h1 {
    font-size: 2.5rem;
    letter-spacing: 2px;
}

/* Style the sections */
.creator {
    background-color: #f3eeee;
    margin: 20px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    border: 2px solid #007bff; /* Add a border */
}

/* Add hover effect to sections */
.creator:hover {
    transform: scale(1.05);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
}

/* Style the creator images */
.creator img {
    max-width: 150px;
    border-radius: 50%;
    margin-right: 20px;
    border: 4px solid #fff;
    transition: border-color 0.3s ease-in-out;
}

/* Add border color change on hover for images */
.creator:hover img {
    border-color: #007bff;
}

/* Style creator details */
.creator-details {
    flex: 1;
}

/* Style h2 for creator names */
.creator-details h2 {
    font-size: 1.8rem;
    color: #333;
    margin-bottom: 10px;
}

/* Style links */
a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s ease-in-out;
}

/* Style links on hover */
a:hover {
    color: #0056b3;
}

    </style>
</head>
<body>
    <header>
        <h1>Meet the Creator of this Website</h1>
    </header>
    <section class="creator">
        <img src="adarsh.jpg" alt="Creator 1">
        <div class="creator-details">
            <h2>Adarsh</h2>
            <p><b>Email:adarsh918g@gmail.com</b></p>
            <p><b>INTMCA(2021-2026)</b></p>
            <p><b>Amal Jyothi College Of Engineering)</b></p>
        </div>
    </section>
