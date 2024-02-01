<?php
date_default_timezone_set('Asia/Manila');
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
                <p>These are the latest sensor data as of (EDIT TO QUERY NG LATEST TIME NG READING)</p>
                <?php
                // Array of sensor tables
                $sensorTables = ["avgsensor1", "avgsensor2", "avgsensor3"];

                // Loop through each sensor table
                foreach ($sensorTables as $sensorTable) {
                    // Fetch all data for the current day
                    $currentDate = date('Y-m-d');
                    $query = "SELECT * FROM $sensorTable WHERE DATE(date) = '$currentDate'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Display the sensor box
                        echo '<div class="sensor-box">';
                        echo '<h3>Micro Controller ' . substr($sensorTable, -1) . '</h3>';

                        // Display Nutrient boxes
                        displayNutrientBox("Nitrogen", $sensorTable, 'avg_nitrogen', $currentDate);
                        displayNutrientBox("Potassium", $sensorTable, 'avg_potassium', $currentDate);
                        displayNutrientBox("Phosphorus", $sensorTable, 'avg_phosphorus', $currentDate);
                        displayNutrientBox("Soil Temperature", $sensorTable, 'avg_soil_temperature', $currentDate);
                        displayNutrientBox("Air Temperature", $sensorTable, 'avg_air_temp', $currentDate);

                        echo '</div>';
                    } else {
                        echo '<div class="sensor-box">';
                        echo '<h3>Sensor ' . substr($sensorTable, -1) . '</h3>';
                        echo '<p class="no-data">No data available for the current day</p>';
                        echo '</div>';
                    }
                }

                // Function to display nutrient data in a box
                function displayNutrientBox($nutrientName, $sensorTable, $nutrientColumn, $currentDate)
                {
                    echo '<div class="nutrient-box">';
                    echo '<strong>' . $nutrientName . '</strong><br>';

                    // Fetch and display raw values
                    $data = fetchData($GLOBALS['conn'], $sensorTable, $nutrientColumn, $currentDate);
                    foreach ($data as $row) {
                        echo implode(', ', $row) . '<br>';
                    }

                    echo '</div>';
                }

                // Function to fetch raw data for a nutrient
                function fetchData($conn, $sensorTable, $nutrient, $currentDate)
                {
                    $data = [];
                    $query = "SELECT $nutrient FROM $sensorTable WHERE DATE(date) = '$currentDate'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $data[] = $row;
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
