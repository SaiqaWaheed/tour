<?php
// edit.php
include "layout.php";
include "connection.php"; // Ensure this file includes your database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform select query to fetch data
    $sql = "SELECT * FROM tourist WHERE tid = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No user found with ID: $id";
        exit();
    }
} else {
    echo "ID parameter not specified.";
    exit();
}
?>

<style>
    body {
        background-color: ;
        background: url(pics/h1.jpg) no-repeat center center fixed;
        background-size: cover; /* Ensures the image covers the entire background */
        background-repeat: no-repeat; /* Prevents the image from repeating */
    }
</style>

<center>
    <div class="card" style="width: 25rem; background-color: rgba(0, 0, 0, 0.7);; padding: 30px; border-radius: 10px; margin-top: 6%;">
        <h2 class="card-title" style="color:green;">Update User</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['tid']); ?>">
            <div class="form-group">
            <b><label for="fname" style="color:green;">First Name:</label></b>
                <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($row['fname']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
            <b><label for="lname" style="color:green;">Last Name:</label></b>
                <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($row['lname']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
            <b><label for="email" style="color:green;">Email:</label></b>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control" required>
            </div>
            <div class="form-group">
            <b><label for="password" style="color:green;">Password:</label></b>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" class="form-control" required>
            </div>
            <input type="submit" value="Update" class="btn btn-primary" style="background-color:green;">
        </form>
    </div>
</center>
