<?php
include "layout.php";
include "connection.php";

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


if (!isset($_SESSION['tid'])) {
    die("Please log in first."); 
}

$tid = $_SESSION['tid']; 

$sql = "SELECT * FROM tourist WHERE tid = '$tid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>
    <div class="container my-5">
        <div class="text-center">
            <h2 style="color: white;">Your Profile</h2>
        </div>
        <div class="glass-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['tid']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['tid']; ?>" class="btn btn-sm btn-outline-warning">Update</a>
                                <a href="delete.php?id=<?php echo $row['tid']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
} else {
    echo "<p style='color: red; text-align: center;'>No Profile Found!</p>";
}
?>

<style>
/* Full Page Background */
body {
    background: url('pics/g17.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
}

/* Glass Table (Grass Green) */
.glass-table {
    width: 80%;
    margin: 20px auto;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 12px;
    backdrop-filter: blur(10px);
    padding: 20px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

/* Table Header */
thead {
    background: rgba(34, 139, 34, 0.8);
    color: white;
}

/*  Table Cells */
th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

/*  Hover Effect */
tr:hover {
    background:black; 
    
}

/* Buttons */
.btn {
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
}

.btn-outline-warning {
    background: orange;
    color: white;
    border: none;
}

.btn-outline-danger {
    background: red;
    color: white;
    border: none;
}

.btn:hover {
    opacity: 0.8;
}
</style>
