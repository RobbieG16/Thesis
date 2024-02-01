<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the month and year parameters are set, otherwise, use the current date
$currentMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
$currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');

$query = $conn->prepare("SELECT DAY(date) as day, MONTH(date) as month, YEAR(date) as year, status FROM ml WHERE MONTH(date) = ? AND YEAR(date) = ?");
$query->bind_param("ss", $currentMonth, $currentYear);
$query->execute();

$result = $query->get_result();

$statusData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $day = $row['day'];
        $month = $row['month'];
        $year = $row['year'];
        $statusData[$day] = array('month' => $month, 'year' => $year, 'status' => $row['status']);
    }
}

header('Content-Type: application/json');
echo json_encode($statusData);

$conn->close();
?>
