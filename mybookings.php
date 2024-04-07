<?php
session_start();
if(!$_SESSION['username'])
{
    header('location:loginpage.php');
}
?>
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "car";

// Create a new connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user's service bookings and statuses
$user_email = $_SESSION['username'];
$sql = "SELECT 
            l.email AS user_email,
            (SELECT MAX(ws.bdate) FROM tbl_washservice ws WHERE ws.lid = l.lid) AS wash_date,
            (SELECT ws.btime FROM tbl_washservice ws WHERE ws.lid = l.lid ORDER BY ws.bdate DESC LIMIT 1) AS wash_time,
            (SELECT ws.status FROM tbl_washservice ws WHERE ws.lid = l.lid ORDER BY ws.bdate DESC LIMIT 1) AS wash_status,
            (SELECT MAX(oil.bdate) FROM tbl_oilchange oil WHERE oil.lid = l.lid) AS oilchange_date,
            (SELECT oil.btime FROM tbl_oilchange oil WHERE oil.lid = l.lid ORDER BY oil.bdate DESC LIMIT 1) AS oilchange_time,
            (SELECT oil.status FROM tbl_oilchange oil WHERE oil.lid = l.lid ORDER BY oil.bdate DESC LIMIT 1) AS oilchange_status,
            (SELECT MAX(ts.bdate) FROM tbl_tierservice ts WHERE ts.lid = l.lid) AS tier_date,
            (SELECT ts.btime FROM tbl_tierservice ts WHERE ts.lid = l.lid ORDER BY ts.bdate DESC LIMIT 1) AS tier_time,
            (SELECT ts.status FROM tbl_tierservice ts WHERE ts.lid = l.lid ORDER BY ts.bdate DESC LIMIT 1) AS tier_status,
            (SELECT MAX(a.bdate) FROM tbl_repairservice a WHERE a.lid = l.lid) AS repair_date,
            (SELECT a.btime FROM tbl_repairservice a WHERE a.lid = l.lid ORDER BY a.bdate DESC LIMIT 1) AS repair_time,
            (SELECT a.status FROM tbl_repairservice a WHERE a.lid = l.lid ORDER BY a.bdate DESC LIMIT 1) AS repair_status
        FROM tbl_login l
        WHERE l.email = '$user_email'";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Bookings</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body><?php include 'navbarforuser.php'?>
    <div class="container">
        <h1>Service Bookings</h1>

        <?php if ($result->num_rows > 0): ?>
    <div class="service-section">
        <h2>Car Wash Service Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Time to Come</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['wash_date']; ?></td>
                        <?php if (!empty($row['wash_time'])): ?>
                            <td><?php echo date("h:i A", strtotime($row['wash_time'])); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo $row['wash_status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="service-section">
        <h2>Tier Service Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Time to Come</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php mysqli_data_seek($result, 0); // Reset result pointer ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['tier_date']; ?></td>
                        <?php if (!empty($row['tier_time'])): ?>
                            <td><?php echo date("h:i A", strtotime($row['tier_time'])); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo $row['tier_status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div class="service-section">
        <h2>Oil Change Service Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Time to Come</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php mysqli_data_seek($result, 0); // Reset result pointer ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['oilchange_date']; ?></td>
                        <?php if (!empty($row['oilchange_time'])): ?>
                            <td><?php echo date("h:i A", strtotime($row['oilchange_time'])); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo $row['oilchange_status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="service-section">
        <h2>Repair Service Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Time to Come</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php mysqli_data_seek($result, 0); // Reset result pointer ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['repair_date']; ?></td>
                        <?php if (!empty($row['repair_time'])): ?>
                            <td><?php echo date("h:i A", strtotime($row['repair_time'])); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo $row['repair_status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No service bookings found for this user.</p>
<?php endif; ?>

    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
