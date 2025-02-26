<?php
include 'connection.php';
session_start(); // Session start zaroori hai

$tid = $_SESSION['tid']; 

// Count unread notifications
$sqlNotifCount = "SELECT COUNT(*) AS unread_count FROM notification WHERE tid = '$tid' AND seen = 0";
$resultNotifCount = mysqli_query($conn, $sqlNotifCount);
$rowNotifCount = mysqli_fetch_assoc($resultNotifCount);
$unreadCount = $rowNotifCount['unread_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="nav.css">

  <title>Beautiful Navbar</title>
</head>
<body>
  <div class="main">
      <ul class="list2">
      
        <li class="logo"><a href="mainPage.html"><img src="earth-globe.png" alt="Logo" style="width:36px;height:36px"></a></li>

        <li><a href="nav.php">Home</a></li>
        <li><a href="destination.html">Destination</a></li>
        <li><a href="signup.php">Profile</a></li>
        <li><a href="requirement.php">Requirements</a></li>
        <li class="notif-container">
        <a href="view_notifications.php" class="notification-link">
          Notification
          <?php if ($unreadCount > 0) { ?>
            <span class="notif-count"><?php echo $unreadCount; ?></span>
          <?php } ?>
        </a>
      </li>

        <li><a href="signin.html">Sign In</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</body>
</html>
