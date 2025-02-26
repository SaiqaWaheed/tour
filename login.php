<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Trim and escape input values to prevent whitespace & SQL issues
        $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
        $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

        // Fetch user details from the database
        $query = "SELECT * FROM tourist WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Failed: " . mysqli_error($conn)); // Debugging: Check for SQL errors
        }

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Store user details in session
            $_SESSION['tid'] = $user['tid'];
            $_SESSION['email'] = $user['email'];

            // Redirect to homepage
            header("Location: nav.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    } else {
        echo "<script>alert('Please enter both email and password.');</script>";
    }
}
?>
