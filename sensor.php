<?php
// Include the database configuration file
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensor Data</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fff;
            color: #495057;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        .sensor-box {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nutrient-box {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
            background-color: #f1f3f5;
        }

        h3 {
            color: #007bff;
        }

        strong {
            color: #28a745;
        }

        .no-data {
            color: #dc3545;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <?php include('sidebar.php'); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-2">
            <div class="container">
                <h2>Sensor Data</h2>

                <?php
                // Array of sensor tables
                $sensorTables = ["rawsensor1", "rawsensor2", "rawsensor3"];

                // Loop through each sensor table
                foreach ($sensorTables as $sensorTable) {
                    // Fetch all data for the sensor at specific times
                    $query = "SELECT * FROM $sensorTable WHERE 
                              TIME(reading_time) IN ('08:00:00', '12:00:00', '16:00:00')";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Calculate averages
                        $averageNitrogen = 0;
                        $averagePotassium = 0;
                        $averagePhosphorus = 0;
                        $averageAirTemp = 0;
                        $averageSoilTemp = 0;
                        $count = 0;

                        while ($row = $result->fetch_assoc()) {
                            $averageNitrogen += $row['nitrogen'];
                            $averagePotassium += $row['potassium'];
                            $averagePhosphorus += $row['phosphorus'];
                            $averageSoilTemp += $row['soil_temperature'];
                            $averageAirTemp += $row['air_temp'];
                            $count++;
                        }

                        // Calculate averages
                        $averageNitrogen /= $count;
                        $averagePotassium /= $count;
                        $averagePhosphorus /= $count;
                        $averageSoilTemp /= $count;
                        $averageAirTemp /= $count;

                        // Display the sensor box
                        echo '<div class="sensor-box">';
                        echo '<h3>Micro Controller ' . substr($sensorTable, -1) . '</h3>';

                        // Display Nutrient boxes
                        displayNutrientBox("Nitrogen", $averageNitrogen, $sensorTable, 'nitrogen');
                        displayNutrientBox("Potassium", $averagePotassium, $sensorTable, 'potassium');
                        displayNutrientBox("Phosphorus", $averagePhosphorus, $sensorTable, 'phosphorus');
                        displayNutrientBox("Soil Temperature", $averageSoilTemp, $sensorTable, 'soil_temperature');
                        displayNutrientBox("Air Temperature", $averageAirTemp, $sensorTable, 'air_temp');

                        echo '</div>';
                    } else {
                        echo '<div class="sensor-box">';
                        echo '<h3>Sensor ' . substr($sensorTable, -1) . '</h3>';
                        echo '<p class="no-data">No data available at specified times</p>';
                        echo '</div>';
                    }
                }

                // Function to display nutrient data in a box
                function displayNutrientBox($nutrientName, $averageValue, $sensorTable, $nutrientColumn)
                {
                    echo '<div class="nutrient-box">';
                    echo '<strong>' . $nutrientName . '</strong><br>';
                    echo 'Average: ' . number_format($averageValue, 2) . '<br>';
                    echo '8:00 am: ' . implode(', ', fetchDataForTime($GLOBALS['conn'], $sensorTable, '08:00:00', $nutrientColumn)) . '<br>';
                    echo '12:00 pm: ' . implode(', ', fetchDataForTime($GLOBALS['conn'], $sensorTable, '12:00:00', $nutrientColumn)) . '<br>';
                    echo '4:00 pm: ' . implode(', ', fetchDataForTime($GLOBALS['conn'], $sensorTable, '16:00:00', $nutrientColumn)) . '<br>';
                    echo '</div>';
                }

                // Function to fetch data for a specific time and nutrient
                function fetchDataForTime($conn, $sensorTable, $time, $nutrient)
                {
                    $data = [];
                    $query = "SELECT $nutrient FROM $sensorTable WHERE TIME(reading_time) = '$time'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $data[] = $row[$nutrient];
                        }
                    }

                    return $data;
                }

                // Close the database connection
                $conn->close();
                ?>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
