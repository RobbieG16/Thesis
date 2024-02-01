<?php

$servername = "localhost";
$username = "esp_data";
$password = "esp_data";
$database = "esp_data";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT 
            DATE(reading_time) as reading_date,
            AVG(nitrogen) AS avg_nitrogen, 
            AVG(potassium) AS avg_potassium, 
            AVG(phosphorus) AS avg_phosphorus, 
            AVG(soil_temperature) AS avg_soil_temperature, 
            AVG(air_temp) AS avg_air_temp 
          FROM rawsensor3 
          GROUP BY reading_date";

$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $avgNitrogen = $row['avg_nitrogen'];
        $avgPotassium = $row['avg_potassium'];
        $avgPhosphorus = $row['avg_phosphorus'];
        $avgSoilTemperature = $row['avg_soil_temperature'];
        $avgAirTemp = $row['avg_air_temp'];
        $readingDate = $row['reading_date'];

        $checkQuery = "SELECT * FROM avgsensor3 WHERE date = '$readingDate'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $updateQuery = "UPDATE avgsensor3 
                            SET avg_nitrogen = '$avgNitrogen', 
                                avg_potassium = '$avgPotassium', 
                                avg_phosphorus = '$avgPhosphorus', 
                                avg_soil_temperature = '$avgSoilTemperature', 
                                avg_air_temp = '$avgAirTemp' 
                            WHERE date = '$readingDate'";

            echo "Update Query: $updateQuery <br>";

            $updateResult = $conn->query($updateQuery);

            if ($updateResult) {
                $statusMessage = "Data fetched and updated successfully.";
            } else {
                $statusMessage = "Error updating data: " . $conn->error;
            }
        } else {
            $insertQuery = "INSERT INTO avgsensor3 
                            (avg_nitrogen, avg_potassium, avg_phosphorus, avg_soil_temperature, avg_air_temp, date) 
                            VALUES ('$avgNitrogen', '$avgPotassium', '$avgPhosphorus', '$avgSoilTemperature', '$avgAirTemp', '$readingDate')";

            echo "Insert Query: $insertQuery <br>";

            $insertResult = $conn->query($insertQuery);

            if ($insertResult) {
                $statusMessage = "Data fetched and inserted successfully.";
            } else {
                $statusMessage = "Error inserting data: " . $conn->error;
            }
        }
    }
} else {
    $statusMessage = "No data fetched for the given date.";
}

$conn->close();

?>
