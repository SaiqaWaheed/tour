<?php
include 'connection.php';
session_start();

$tid = $_SESSION['tid']; // Current logged-in tourist ID

// Check for new notifications
$sqlNew = "SELECT COUNT(*) AS new_notifs FROM notification WHERE tid = '$tid' AND seen = 0";
$resultNew = mysqli_query($conn, $sqlNew);
$rowNew = mysqli_fetch_assoc($resultNew);

// Show alert if new notifications are available
if ($rowNew['new_notifs'] > 0) {
    echo "<script>alert('You have new weather notifications!');</script>";
}

// Mark all notifications as read
$updateSql = "UPDATE notification SET seen = 1 WHERE tid = '$tid'";
mysqli_query($conn, $updateSql);

// Fetch all notifications
$sql = "SELECT * FROM notification WHERE tid = '$tid' ORDER BY notif_id DESC";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Notifications</title>
    <style>
        /*Full Page Background */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url(notif.jpg) no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-size: cover;
        }

        /* Container */
        .container {
            width: 80%;
            max-width: 600px;
            padding: 20px;
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.7);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            color: white;
            text-align: center;
            backdrop-filter: blur(8px);
            border: 2px solid green; 
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: white; 
            text-shadow: 0px 0px 10px #0ef;
            
        }

        /* 🔹 Notification Cards */
        .notification {
            background: rgba(0, 0, 0, 0.5);
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(14, 239, 255, 0.4);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .notification:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 25px rgba(14, 239, 255, 0.8);
        }

        /* 🔹 Date Styling */
        .date {
            font-size: 14px;
            color: white; /* Neon Pink */
            font-weight: bold;
        }

        /* 🔹 Notification Text */
        .message {
            font-size: 16px;
            color: red; /* Electric Blue */
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>Your Notifications</h2>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='notification'>";
            echo "<p class='date'>" . $row['notif_date'] . "</p>";
            echo "<p class='message'>" . $row['notif_message'] . "</p>";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>
