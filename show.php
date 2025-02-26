<?php
// show.php

include "layout.php";
include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            background-color:grey;
            background-image: url('pic/p8.jpg');
            background-size: cover; 
            background-repeat: no-repeat; 
            
        
        }
        /* Internal CSS for card styling */
        .card {
            width: 60%;
            height:60%;
            border: none; /* Remove border */
            border-radius: 10px;
            box-shadow: black;
        }

        .card-header {
            background-color: navy; /* Primary color for header */
            color: #fff; /* Text color */
            font-size: 1.5rem;
            text-align: center;
            padding: 10px 0;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            background-color: navyblue;
            font-size: 1.2rem;
            padding: 20px;
        }

        .card-title {
            font-size: 2rem;
            color: black;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1.1rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Query to fetch user details based on user_id
            $sql = "SELECT * FROM tourist WHERE tid = $id";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    // Display user details
        ?>
        <center>
                    <div class="card">
                        <div class="card-header">
                            User Details
                        </div>
                        <center>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['fname']; ?></h5>
                            <h5 class="card-title"><?php echo $row['lname']; ?></h5>
                            <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
                            <p class="card-text"><strong>Password:</strong> <?php echo $row['password']; ?></p>
                        </div>
                </center>
                    </div>
                    </center>
        <?php
                } else {
                    echo '<div class="alert alert-warning" role="alert">No user found with ID: ' . $id . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($conn) . '</div>';
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            echo '<div class="alert alert-info" role="alert">User ID not specified.</div>';
        }
        ?>
    </div>
</body>
</html>
