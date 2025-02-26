<?php
// delete.php

include "connection.php"; // Ensure this file includes your database connection

if(isset($_GET['id']) ) {
    $id = $_GET['id'];

    // Perform deletion query
    $sql = "DELETE FROM tourist WHERE tid = $id";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        header('location:signup.php');
    }
}
?>
