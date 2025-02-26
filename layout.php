<?php
include 'connection.php';
session_start(); // Session start karna zaroori hai

$tid = $_SESSION['tid']; 

// Count unread notifications
$sqlNotifCount = "SELECT COUNT(*) AS unread_count FROM notification WHERE tid = '$tid' AND seen = 0";
$resultNotifCount = mysqli_query($conn, $sqlNotifCount);
$rowNotifCount = mysqli_fetch_assoc($resultNotifCount);
$unreadCount = $rowNotifCount['unread_count'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <style>

    /* Navbar links styling */
    .navbar-nav .nav-item .nav-link {
      color: green; /* Text color */
      font-weight: 600;
    }

    .navbar-nav .nav-item .nav-link:hover {
      color:white; /* Text color on hover */
    }

    /* Form input styling */
    .form-control {
      width: 300px; /* Adjust width as needed */
    }

    /* Button styling */
    .btn-outline-success {
      color: #28a745; /* Button text color */
      border-color: #28a745; /* Button border color */
    }

    .btn-outline-success:hover {
      color: #fff; /* Button text color on hover */
      background-color: #28a745; /* Button background color on hover */
      border-color: #28a745; /* Button border color on hover */
    }

    /* Navbar background color */
    .navbar {
      background-color: rgb(0,0,0,0.7); /* Change this color to your preferred background color */
    }
    .notif-container {
  position: relative;
}

.notif-count {
  background: red;
  color: white;
  font-size: 12px;
  font-weight: bold;
  border-radius: 50%;
  padding: 3px 6px;
  position: absolute;
  top: 6px;  /* ✅ Niche adjust kiya */
  right: -12px;
  min-width: 18px;
  text-align: center;
  line-height: 18px;
}

  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
  
  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="nav.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Create_profile</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="requirement.php">Requirements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">My Profile</a>
      </li>
      <li class="nav-item notif-container">
        <a  href="view_notifications.php" class="nav-link notification-link">
          Notification
          <?php if ($unreadCount > 0) { ?>
            <span class="notif-count"><?php echo $unreadCount; ?></span>
          <?php } ?>
        </a>
      </li>
      <li class="nav-item"><a class="nav-link" href="signin.html">Sign In</a></li>
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>

    

      <!-- Add more navbar links as needed -->
    </ul>
    
   
  </div>
</nav>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>



  