
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esp_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function getLatestSensorData($conn, $sensorTable)
{
    $query = "SELECT * FROM $sensorTable ORDER BY reading_time DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}

?>
