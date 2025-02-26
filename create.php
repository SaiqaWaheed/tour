<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // No hashing, storing as plain text

    $sql = "INSERT INTO tourist (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: signin.html');
        exit();
    } else {
        echo "Data Not Inserted";
    }
}
?>