<?php
// update.php

include "connection.php"; // Ensure this file includes your database connection

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform update query
    $sql = "UPDATE tourist SET fname = '$fname', lname = '$lname', email = '$email', password = '$password' WHERE tid = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: signup.php'); // Redirect to signup.php after successful update
        exit;
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
} else {
    echo "ID parameter not specified.";
}
?>
