<?php
session_start();
include('connection.php'); // Database connection include

// Fetch destinations from visitspot table
$destinationQuery = "SELECT DISTINCT v_location FROM visitspot";
$destinationResult = mysqli_query($conn, $destinationQuery);

if (isset($_POST["insert"])) {
    $budget = $_POST["budget"];
    $noOfDays = $_POST["noOfDays"];
    $destination = $_POST["destination"];

    if (!isset($_SESSION['tid'])) {
        echo '<span style="color:red;">Error: Tourist ID not found in session.</span>';
        exit();
    }

    $tid = $_SESSION['tid'];

    // Insert into requirements table
    $insertRequirement = "INSERT INTO requirements (tid, budget, noOfDays, destination) 
                          VALUES ('$tid', '$budget', '$noOfDays', '$destination')";

    if (mysqli_query($conn, $insertRequirement)) {
        $rid = mysqli_insert_id($conn); // Get the inserted requirement ID

        // Fetch visitspot ID for selected destination
        $visitSpotQuery = "SELECT vid FROM visitspot WHERE v_location = '$destination'";
        $visitSpotResult = mysqli_query($conn, $visitSpotQuery);
        if ($row = mysqli_fetch_assoc($visitSpotResult)) {
            $visitspot_id = $row['vid'];

            // Insert into visitspot_requirement table
            $insertVisitspotRequirement = "INSERT INTO visitspot_requirement (visitspot_id, rid) 
                                           VALUES ('$visitspot_id', '$rid')";
            mysqli_query($conn, $insertVisitspotRequirement);
        }

        // Insert into tourplan table
        $tourCost = rand(5000, 20000);
        $planStatus = "Pending";
        $insertTourPlan = "INSERT INTO tourplan (rid, s_date, e_date, plan_status, tour_cost, noOfDays) 
                           VALUES ('$rid', CURDATE(), DATE_ADD(CURDATE(), INTERVAL $noOfDays DAY), '$planStatus', '$tourCost', '$noOfDays')";

        if (mysqli_query($conn, $insertTourPlan)) {
            $p_id = mysqli_insert_id($conn); // Get the inserted tourplan ID

            // Insert hotels
            $hotelQuery = "SELECT hotel_id FROM hotel WHERE location = '$destination' ORDER BY rating DESC LIMIT 2";
            $hotelResult = mysqli_query($conn, $hotelQuery);
            while ($hotel = mysqli_fetch_assoc($hotelResult)) {
                mysqli_query($conn, "INSERT INTO tourplan_hotel (p_id, hotel_id) VALUES ('$p_id', '{$hotel['hotel_id']}')");
            }

            // Insert restaurants
            $restaurantQuery = "SELECT restaurant_id FROM restaurant WHERE location = '$destination' ORDER BY R_price ASC LIMIT 2";
            $restaurantResult = mysqli_query($conn, $restaurantQuery);
            while ($restaurant = mysqli_fetch_assoc($restaurantResult)) {
                mysqli_query($conn, "INSERT INTO tourplan_restaurant (p_id, restaurant_id) VALUES ('$p_id', '{$restaurant['restaurant_id']}')");
            }

            // Insert transport
            $transportQuery = "SELECT transport_id FROM transport WHERE transport_type IN ('Bus', 'Train') LIMIT 1";
            $transportResult = mysqli_query($conn, $transportQuery);
            while ($transport = mysqli_fetch_assoc($transportResult)) {
                mysqli_query($conn, "INSERT INTO tourplan_transport (p_id, transport_id) VALUES ('$p_id', '{$transport['transport_id']}')");
            }

            // Insert famous spots
            $famousSpotQuery = "SELECT sid FROM famousspot WHERE location = '$destination' LIMIT 3";
            $famousSpotResult = mysqli_query($conn, $famousSpotQuery);
            while ($spot = mysqli_fetch_assoc($famousSpotResult)) {
                mysqli_query($conn, "INSERT INTO tourplan_famousspot (p_id, sid) VALUES ('$p_id', '{$spot['sid']}')");
            }

            // Redirect to view tour plan page
            header("Location: view_tourplan.php");
            exit();
        } else {
            echo '<span style="color:red;">Error generating Tour Plan: ' . mysqli_error($conn) . '</span>';
        }
    } else {
        echo '<span style="color:red;">Error inserting requirements: ' . mysqli_error($conn) . '</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Plan Insertion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url(pics/g17.jpg) no-repeat center center fixed;
            background-size: cover;
            text-align: center;
            padding: 20px;
        }
        form {
            background: rgba(0, 0, 0, 0.7);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #aaa;
            width: 35%;
            margin: auto;
            margin-top: 5%;
            text-align: left;
        }
        label {
            font-weight: bold;
            color: green;
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
            font-size: 16px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            margin-top: 15px;
        }
        button:hover {
            background-color: #218838;
        }
        span {
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2 style="margin-top:5%; color:white;">Enter Your Tour Requirements</h2>

<form method="POST" action="insertion.php">
    <label for="budget">Budget:</label>
    <input type="number" name="budget" id="budget" required>

    <label for="noOfDays">Number of Days:</label>
    <input type="number" name="noOfDays" id="noOfDays" required>

    <label for="destination">Destination:</label>
    <select style="width:100%" name="destination" id="destination" required>
        <option value="">Select Destination</option>
        <?php while ($row = mysqli_fetch_assoc($destinationResult)) { ?>
            <option value="<?php echo $row['v_location']; ?>">
                <?php echo $row['v_location']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit" name="insert">Generate Tour Plan</button>
</form>

</body>
</html>
