<?php
include 'connection.php';

if (!isset($_GET['p_id'])) {
    die("Invalid request!");
}

$p_id = $_GET['p_id'];

//Remove links from many-to-many tables
mysqli_query($conn, "DELETE FROM tourplan_hotel WHERE p_id = '$p_id'");
mysqli_query($conn, "DELETE FROM tourplan_restaurant WHERE p_id = '$p_id'");
mysqli_query($conn, "DELETE FROM tourplan_famousspot WHERE p_id = '$p_id'");

//Delete the main tour plan
$sql = "DELETE FROM tourplan WHERE p_id = '$p_id'";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Tour plan deleted successfully!'); window.location.href = 'view_tourplan.php';</script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
