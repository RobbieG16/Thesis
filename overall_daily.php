<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "esp_data";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch avg_nitrogen, avg_potassium, avg_phosphorus, avg_soil_temperature, avg_air_temp, and date values
$query = "SELECT 
            DATE(date) as reading_date,
            AVG(avg_nitrogen) AS avg_nitrogen, 
            AVG(avg_potassium) AS avg_potassium, 
            AVG(avg_phosphorus) AS avg_phosphorus, 
            AVG(avg_soil_temperature) AS avg_soil_temperature, 
            AVG(avg_air_temp) AS avg_air_temp 
          FROM (
            SELECT date, avg_nitrogen, avg_potassium, avg_phosphorus, avg_soil_temperature, avg_air_temp FROM avgsensor1
            UNION ALL
            SELECT date, avg_nitrogen, avg_potassium, avg_phosphorus, avg_soil_temperature, avg_air_temp FROM avgsensor2
            UNION ALL
            SELECT date, avg_nitrogen, avg_potassium, avg_phosphorus, avg_soil_temperature, avg_air_temp FROM avgsensor3
          ) AS subquery GROUP BY reading_date";

$result = $conn->query($query);

if (!$result) {
    echo "Error: " . $conn->error;
}

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "Date: " . $row['reading_date'] . "<br>";
        echo "Average Nitrogen: " . $row['avg_nitrogen'] . "<br>";
        echo "Average Potassium: " . $row['avg_potassium'] . "<br>";
        echo "Average Phosphorus: " . $row['avg_phosphorus'] . "<br>";
        echo "Average Soil Temperature: " . $row['avg_soil_temperature'] . "<br>";
        echo "Average Air Temperature: " . $row['avg_air_temp'] . "<br>";
        echo "--------------------------<br>";

        $readingDate = $row['reading_date'];
        $avgNitrogen = $row['avg_nitrogen'];
        $avgPotassium = $row['avg_potassium'];
        $avgPhosphorus = $row['avg_phosphorus'];
        $avgSoilTemperature = $row['avg_soil_temperature'];
        $avgAirTemp = $row['avg_air_temp'];

        // Insert the calculated average values into the overall_data table
        $insertQuery = "INSERT INTO overall_data 
                        (reading_date, all_nitrogen, all_potassium, all_phosphorus, all_soil_temperature, all_air_temp) 
                        VALUES ('$readingDate', '$avgNitrogen', '$avgPotassium', '$avgPhosphorus', '$avgSoilTemperature', '$avgAirTemp') 
                        ON DUPLICATE KEY UPDATE 
                        all_nitrogen = '$avgNitrogen', 
                        all_potassium = '$avgPotassium', 
                        all_phosphorus = '$avgPhosphorus', 
                        all_soil_temperature = '$avgSoilTemperature', 
                        all_air_temp = '$avgAirTemp'";
                        
        $insertResult = $conn->query($insertQuery);

        if ($insertResult) {
            echo "Data inserted/updated successfully for $readingDate<br>";
        } else {
            echo "Error inserting/updating data: " . $conn->error . "<br>";
        }
    }
} else {
    echo "No data fetched.";
}

$conn->close();
?>
