<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #db1010;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }

        .services {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 2rem;
        }

        .service {
            text-align: center;
            margin: 1rem;
        }

        .service img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .service h2 {
            margin-top: 10px;
        }

        .service a {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #d01010;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-to-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-home a {
            background-color: #d01010; /* Red color */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Book Our Services</h1>
    </header>

    <main>
        <section class="services">
            <div class="service">
                <img src="carrepairing.gif" alt="Car Repairs">
                <h2>Car Repairs</h2>
                <a href="carrepair.php">Book</a>
            </div>
            <div class="service">
                <img src="cardetailing.gif" alt="Car Detailing">
                <h2>Car Detailing</h2>
                <a href="carwash.php">Book</a>
            </div>
            <div class="service">
                <img src="cartireservice.gif" alt="Tire Services">
                <h2>Tire Services</h2>
                <a href="tier.php">Book</a>
            </div>
            <div class="service">
                <img src="caroil.gif" alt="Oil Change">
                <h2>Oil Change</h2>
                <a href="oilchange.php">Book</a>
            </div>
        </section>

       
    </main>
</body>
</html>
