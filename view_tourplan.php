<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['tid'])) {
    die("Please log in first.");
}

$loggedInTid = $_SESSION['tid']; // Get logged-in user's tourist ID

// Fetch only the logged-in user's tour plans using many-to-many tables
$sql = "SELECT tp.p_id, tp.s_date, tp.e_date, tp.plan_status, tp.tour_cost, tp.noOfDays,
            r.tid,
            GROUP_CONCAT(DISTINCT h.hotel_name, ' (', h.location, ') - <a href=\"', h.externalBookingLink, '\" target=\"_blank\" style=\"color:green;\">Book</a>' SEPARATOR '<br>') AS hotels,
            GROUP_CONCAT(DISTINCT res.restaurant_name, ' (', res.location, ') - <a href=\"', res.externalBookingLink, '\" target=\"_blank\" style=\"color:green;\">Book</a>' SEPARATOR '<br>') AS restaurants,
            GROUP_CONCAT(DISTINCT t.transport_type, ' - ', t.company_name, ' - <a href=\"', t.externalBookingLink, '\" target=\"_blank\" style=\"color:green;\">Book</a>' SEPARATOR '<br>') AS transports,
            GROUP_CONCAT(DISTINCT f.Fspot_name, ' (', f.location, ')' SEPARATOR '<br>') AS famous_spots
        FROM tourplan tp
        LEFT JOIN requirements r ON tp.rid = r.rid
        LEFT JOIN tourplan_hotel th ON tp.p_id = th.p_id
        LEFT JOIN hotel h ON th.hotel_id = h.hotel_id
        LEFT JOIN tourplan_restaurant tr ON tp.p_id = tr.p_id
        LEFT JOIN restaurant res ON tr.restaurant_id = res.restaurant_id
        LEFT JOIN tourplan_transport tt ON tp.p_id = tt.p_id
        LEFT JOIN transport t ON tt.transport_id = t.transport_id
        LEFT JOIN tourplan_famousspot tf ON tp.p_id = tf.p_id
        LEFT JOIN famousspot f ON tf.sid = f.sid
        WHERE r.tid = '$loggedInTid'
        GROUP BY tp.p_id"; // Group by plan ID to merge multiple entries

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Tour Plans</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-image: url('pics/g17.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            margin: 0;
            padding: 0;
        }
        .navbar {
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            padding: 15px 0;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            font-size: 16px;
            font-weight: bold;
            margin: 0 10px;
        }
        .navbar a:hover {
            background: white;
            color:black;
            border-radius: 5px;
        }
        .container {
            width: 90%;
            margin: 80px auto 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0, 0.4);
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid white;
            padding: 10px;
            text-align: center;
        }
        th {
            background: green;
            color: black;
        }
        td {
            color: white;
        }
        .btn {
            padding: 5px 15px;
            border: 2px solid black;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
            width: 80px;
            margin: 0 5px;
            transition: 0.3s;
            font-weight: bold;
        }
        .delete-btn {
            color: red;
            border-color: red;
        }
        .delete-btn:hover {
            background-color: red;
            color: white;
        }
        .edit-btn {
            color: blue;
            border-color: blue;
        }
        .edit-btn:hover {
            background-color: blue;
            color: white;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="nav.php">Home</a>
        <a href="insertion.php">Insert Details</a>
        <a href="view.php">View Requirements</a>
        <a href="view_tourplan.php">View Tour Plans</a>
    </div>

    <div class="container">
        <h2 style="text-align:center; color:white;">Your Tour Plans</h2>
        <table>
            <tr>
                <th>Plan ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Cost</th>
                <th>Days</th>
                <th>Hotels</th>
                <th>Restaurants</th>
                <th>Transport</th>
                <th>Famous Spots</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['p_id']; ?></td>
                    <td><?php echo $row['s_date']; ?></td>
                    <td><?php echo $row['e_date']; ?></td>
                    <td><?php echo $row['plan_status']; ?></td>
                    <td><?php echo $row['tour_cost']; ?></td>
                    <td><?php echo $row['noOfDays']; ?></td>
                    <td><?php echo $row['hotels']; ?></td>
                    <td><?php echo $row['restaurants']; ?></td>
                    <td><?php echo $row['transports']; ?></td>
                    <td><?php echo $row['famous_spots']; ?></td>
                    <td style="width: 150px; text-align: center;">
                        <a href="delete_tourplan.php?p_id=<?php echo $row['p_id']; ?>" 
                            onclick="return confirm('Are you sure you want to delete this tour plan?');" 
                            class="btn delete-btn">
                            Delete
                        </a>
                        <a href="edit_tourplan.php?p_id=<?php echo $row['p_id']; ?>" 
                            class="btn edit-btn">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>
