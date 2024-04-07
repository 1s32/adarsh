<?php
$conn = new mysqli('localhost', 'root', '', 'car');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['block'])) {
    $a = $_POST['email'];
    $sql = "UPDATE tbl_login SET status='blocked' WHERE email='$a'";
    if($conn->query($sql) === TRUE) {
        // Block action successful
      
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['unblock'])) {
    $a = $_POST['email'];
    $sql = "UPDATE tbl_login SET status='unblocked' WHERE email='$a'";
    if($conn->query($sql) === TRUE) {
        // Unblock action successful
    
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch users from the database
$sql = "SELECT email, status FROM tbl_login where role!='admin'";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Block/Unblock User Page</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .block, .unblock {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .block {
            background-color: #ff4d4d; /* Red color */
            color: white;
        }

        .unblock {
            background-color: #4caf50; /* Green color */
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <?php include'navbar.php'; ?>
    <h1>Block/Unblock Users</h1>
    <table>
        <tr>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["status"]."</td>";
                echo "<td>";
                if ($row["status"] == 'blocked') {
                    echo '<form action="#" method="POST"><input type="hidden" name="email" value="' . $row["email"] . '"><button class="unblock" type="submit" name="unblock">Unblock</button></form>';
                } else {
                    echo '<form action="#" method="POST"><input type="hidden" name="email" value="' . $row["email"] . '"><button class="block" type="submit" name="block">Block</button></form>';
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>