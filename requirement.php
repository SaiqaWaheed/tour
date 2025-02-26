<?php
session_start();
include("connection.php"); // Include the database connection file

// Ensure the user is logged in
if (!isset($_SESSION['tid'])) {
    echo '<span style="color:red;">Error: Tourist not logged in.</span>';
    exit();
}

$tid = $_SESSION['tid']; // Get logged-in tourist's ID
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Requirements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url(pics/g17.jpg) no-repeat center center fixed;
            background-size: cover;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 200px;
            background: rgba(0, 0, 0, 0.4);
            color: #fff;
            padding: 15px;
            height: 100vh;
        }

        .sidebar h2, .sidebar h5 {
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            display: block;
            transition: background 0.3s;
        }

        .sidebar ul li a:hover {
            background: rgba(135, 206, 250, 0.4);
        }

        .main2 {
            flex-grow: 1;
            padding: 20px;
        }

        .title_area {
            text-align: center;
            color: green;
        }

        table {
            background: rgba(0, 0, 0, 0.4);
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: wheat;
            text-align: center;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: green;
            color: black;
        }

        tr:hover {
            background: rgba(135, 206, 250, 0.4);
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <h2>Requirement Panel</h2>
        <h5>Tour Controller</h5>
        <ul>
            <li><a href="nav.php">Home</a></li>
            <li><a href="insertion.php">Insert Details</a></li>
            <li class="active"><a href="view.php">View Tour Table</a></li>
            <li><a href="view_tourplan.php">View Tour Plans</a></li>
        </ul>
    </div>

    <div class="main2">
        <h2 class="title_area">Your Tour Requirements</h2>

        <table>
            <tr>
                <th>Requirement ID</th>
                <th>Budget</th>
                <th>No of Days</th>
                <th>Destination</th>
            </tr>

            <?php
            $sql = "SELECT rid, budget, noOfDays, destination FROM requirements WHERE tid = '$tid'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['rid'] . "</td>";
                    echo "<td>" . $row['budget'] . "</td>";
                    echo "<td>" . $row['noOfDays'] . "</td>";
                    echo "<td>" . $row['destination'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center; color:red;'>No records found</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </table>
    </div>
</div>
</body>
</html>
