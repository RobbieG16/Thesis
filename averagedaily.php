<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "esp_data";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentDate = date("Y-m-d");

$query = "SELECT AVG(nitrogen) AS avg_nitrogen, AVG(potassium) AS avg_potassium, AVG(phosphorus) AS avg_phosphorus, AVG(soil_temperature) AS avg_soil_temperature, AVG(air_temp) AS avg_air_temp, MAX(reading_time) AS latest_time FROM sensor1 WHERE DATE(reading_time) = '$currentDate'";

$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();

    $avgNitrogen = $row['avg_nitrogen'];
    $avgPotassium = $row['avg_potassium'];
    $avgPhosphorus = $row['avg_phosphorus'];
    $avgSoilTemperature = $row['avg_soil_temperature'];
    $avgAirTemp = $row['avg_air_temp'];
    $latestTime = $row['latest_time'];

    $insertQuery = "INSERT INTO dailysensor1 (nitrogen, potassium, phosphorus, soil_temperature, air_temp, date, latest_time) VALUES ('$avgNitrogen', '$avgPotassium', '$avgPhosphorus', '$avgSoilTemperature', '$avgAirTemp', '$currentDate', '$latestTime')";

    $insertResult = $conn->query($insertQuery);

    if ($insertResult) {
        $statusMessage = "Data fetched and inserted successfully. Latest time: $latestTime";
    } else {
        $statusMessage = "Error inserting data: " . $conn->error;
    }
} else {
    $statusMessage = "No data fetched for the given date.";
}

$conn->close();

// Output HTML directly
echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Data Fetch and Insert Status</title>
</head>
<body>
    <h1>Data Fetch and Insert Status</h1>
    <p>Status: $statusMessage</p>
</body>
</html>";
?>
