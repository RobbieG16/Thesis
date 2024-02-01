<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .weather-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .weather-item {
            margin: 10px 0;
        }
        .weather-item span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    $apiKey = "b8d8951d0647b46d1d67005e2141420e";
    $cityId = "1694008"; // Numeric city ID for Laoag, PH
    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&appid=" . $apiKey . "&units=metric";

    $response = file_get_contents($apiUrl);
    $weatherData = json_decode($response);

    // Accessing specific data
    $temperature = $weatherData->main->temp;
    $humidity = $weatherData->main->humidity;
    $rainfall = isset($weatherData->rain) ? $weatherData->rain->{'1h'} : 0; // Rainfall in the last hour
    ?>

    <div class="weather-container">
        <div class="weather-item">
            <span>Temperature:</span> <span><?php echo $temperature; ?></span> °C
        </div>
        <div class="weather-item">
            <span>Humidity:</span> <span><?php echo $humidity; ?></span>%
        </div>
        <div class="weather-item">
            <span>Rainfall (last 1 hour):</span> <span><?php echo $rainfall; ?></span> mm
        </div>
    </div>
    
    <script>
        // This would be your PHP data encoded as JSON
        // Ideally, you would get this data through an AJAX call to your server
        const weatherData = <?php echo json_encode($weatherData); ?>;

        document.getElementById('temperature').textContent = weatherData.main.temp;
        document.getElementById('humidity').textContent = weatherData.main.humidity;
        document.getElementById('rainfall').textContent = weatherData.rain ? weatherData.rain['1h'] : '0';
    </script>
</body>
</html>
