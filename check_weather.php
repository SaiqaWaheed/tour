<?php
include 'connection.php';

// Function to fetch weather data using cURL
function getWeather($city) {
    $apiKey = "30202f78f589a24b75df879e014301f6"; // اپنا OpenWeatherMap API Key یہاں رکھیں
    $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) { // API نے کامیابی سے جواب دیا
        return json_decode($response, true);
    } else {
        return false;
    }
    $response = curl_exec($ch);
curl_close($ch);

echo "<pre>";
print_r($response); // یہ API کا مکمل جواب دکھائے گا
echo "</pre>";

return json_decode($response, true);

}

// Fetch all active tour plans
$query = "SELECT t.p_id, t.s_date, t.e_date, r.destination, r.tid 
          FROM tourplan t 
          JOIN requirements r ON t.rid = r.rid
          WHERE t.plan_status = 'Pending'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching tour plans: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    $destination = mysqli_real_escape_string($conn, $row['destination']);
    $tid = $row['tid'];

    echo "Processing: $destination for Tourist ID: $tid <br>";

    $weatherData = getWeather($destination);
    

    if ($weatherData && isset($weatherData['weather'][0]['main']) && isset($weatherData['main']['temp'])) {
        $weatherCondition = $weatherData['weather'][0]['main'];
        $temp = $weatherData['main']['temp'];

        // Define unpleasant conditions
        $unpleasantConditions = ['Rain', 'Snow', 'Thunderstorm', 'Extreme'];

        if (in_array($weatherCondition, $unpleasantConditions) || $temp < 5 || $temp > 35) {
            $message = "Alert: Unpleasant weather expected in $destination. Condition: $weatherCondition, Temperature: {$temp}°C.";

            // Debugging: Show which notifications are inserted
            echo "Inserting notification for $destination - $message <br>";

            // Insert notification
            $notifQuery = "INSERT INTO notification (tid, notif_message) VALUES ('$tid', '$message')";
            if (!mysqli_query($conn, $notifQuery)) {
                echo "Error inserting notification: " . mysqli_error($conn) . "<br>";
            }
        } else {
            echo "Weather is good in $destination. No notification needed.<br>";
        }
    } else {
        echo "Weather data not available for $destination<br>";
    }
}

echo "Weather check complete!";
?>
