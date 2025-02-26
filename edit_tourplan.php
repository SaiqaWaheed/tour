<?php
include 'connection.php';
session_start();

if (!isset($_GET['p_id'])) {
    die("Invalid request!");
}

$p_id = $_GET['p_id'];

// Fetch existing tour plan details
$sql = "SELECT * FROM tourplan WHERE p_id = '$p_id'";
$result = mysqli_query($conn, $sql);
$plan = mysqli_fetch_assoc($result);

// Fetch associated hotels
$hotel_query = "SELECT hotel_id FROM tourplan_hotel WHERE p_id = '$p_id'";
$hotel_result = mysqli_query($conn, $hotel_query);
$selected_hotels = [];
while ($row = mysqli_fetch_assoc($hotel_result)) {
    $selected_hotels[] = $row['hotel_id'];
}

// Fetch associated restaurants
$restaurant_query = "SELECT restaurant_id FROM tourplan_restaurant WHERE p_id = '$p_id'";
$restaurant_result = mysqli_query($conn, $restaurant_query);
$selected_restaurants = [];
while ($row = mysqli_fetch_assoc($restaurant_result)) {
    $selected_restaurants[] = $row['restaurant_id'];
}

// Fetch associated famous spots
$spot_query = "SELECT sid FROM tourplan_famousspot WHERE p_id = '$p_id'";
$spot_result = mysqli_query($conn, $spot_query);
$selected_spots = [];
while ($row = mysqli_fetch_assoc($spot_result)) {
    $selected_spots[] = $row['sid'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $s_date = $_POST['s_date'];
    $e_date = $_POST['e_date'];
    $plan_status = $_POST['plan_status'];
    $tour_cost = $_POST['tour_cost'];
    $noOfDays = $_POST['noOfDays'];
    $hotel_id = $_POST['hotel_id'];
    $restaurant_id = $_POST['restaurant_id'];
    $spot_id = $_POST['spot_id'];

    // Update main tour plan
    $update_sql = "UPDATE tourplan SET 
                    s_date = '$s_date', 
                    e_date = '$e_date', 
                    plan_status = '$plan_status', 
                    tour_cost = '$tour_cost', 
                    noOfDays = '$noOfDays'
                    WHERE p_id = '$p_id'";
    mysqli_query($conn, $update_sql);

    // Update hotels
    mysqli_query($conn, "DELETE FROM tourplan_hotel WHERE p_id = '$p_id'");
    mysqli_query($conn, "INSERT INTO tourplan_hotel (p_id, hotel_id) VALUES ('$p_id', '$hotel_id')");

    // Update restaurants
    mysqli_query($conn, "DELETE FROM tourplan_restaurant WHERE p_id = '$p_id'");
    mysqli_query($conn, "INSERT INTO tourplan_restaurant (p_id, restaurant_id) VALUES ('$p_id', '$restaurant_id')");

    // Update famous spots
    mysqli_query($conn, "DELETE FROM tourplan_famousspot WHERE p_id = '$p_id'");
    mysqli_query($conn, "INSERT INTO tourplan_famousspot (p_id, sid) VALUES ('$p_id', '$spot_id')");

    echo "<script>alert('Tour plan updated successfully!'); window.location.href = 'view_tourplan.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tour Plan</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('pics/g17.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            margin: 0;
            padding: 0;
            
        }
        .container {
            width: 40%;
            margin: 50px auto;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
        }
        h2 {
            text-align: center;
            color: green;
        }
        label {
            font-weight: bold;
            color: green;
            display: block;
            margin-top: 10px;
        }
        input {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        select{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background: green;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }
        input[type="submit"]:hover {
            background: darkgreen;
            
        }
        input[type="submit"]{
            width: 50%;
            margin-left:25%;
        }

    </style>
</head>
<body>
<div class="container">
    <h2>Edit Tour Plan</h2>
    <form method="post">
        <label>Start Date:</label>
        <input type="date" name="s_date" value="<?php echo $plan['s_date']; ?>" required>

        <label>End Date:</label>
        <input type="date" name="e_date" value="<?php echo $plan['e_date']; ?>" required>

        <label>Status:</label>
        <input type="text" name="plan_status" value="<?php echo $plan['plan_status']; ?>" required>

        <label>Cost:</label>
        <input type="number" name="tour_cost" value="<?php echo $plan['tour_cost']; ?>" required>

        <label>Days:</label>
        <input type="number" name="noOfDays" value="<?php echo $plan['noOfDays']; ?>" required>

        <label>Select Hotel:</label>
        <select name="hotel_id" required>
            <?php
            $hotels = mysqli_query($conn, "SELECT * FROM hotel");
            while ($hotel = mysqli_fetch_assoc($hotels)) {
                $selected = ($hotel['hotel_id'] == $selected_hotels[0]) ? 'selected' : '';
                echo "<option value='{$hotel['hotel_id']}' $selected>{$hotel['hotel_name']} ({$hotel['location']})</option>";
            }
            ?>
        </select>

        <label>Select Restaurant:</label>
        <select name="restaurant_id" required>
            <?php
            $restaurants = mysqli_query($conn, "SELECT * FROM restaurant");
            while ($restaurant = mysqli_fetch_assoc($restaurants)) {
                $selected = ($restaurant['restaurant_id'] == $selected_restaurants[0]) ? 'selected' : '';
                echo "<option value='{$restaurant['restaurant_id']}' $selected>{$restaurant['restaurant_name']} ({$restaurant['location']})</option>";
            }
            ?>
        </select>

        <label>Select Famous Spot:</label>
        <select name="spot_id" required>
            <?php
            $spots = mysqli_query($conn, "SELECT * FROM famousspot");
            while ($spot = mysqli_fetch_assoc($spots)) {
                $selected = ($spot['sid'] == $selected_spots[0]) ? 'selected' : '';
                echo "<option value='{$spot['sid']}' $selected>{$spot['Fspot_name']} ({$spot['location']})</option>";
            }
            ?>
        </select>

        <input type="submit" value="Update">
    </form>
</div>
</body>
</html>
