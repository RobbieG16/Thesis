<?php
// Filename: controller.php

$filename = 'interval_setting2.txt';

// If it's a POST request, update the interval setting
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['interval'])) {
    $interval = intval($_POST['interval']);
    // Ensure the interval is within the allowed range (1 min to 8 hours)
    $interval = max(60000, min($interval, 28800000));
    file_put_contents($filename, $interval);

    // Redirect back to the slider interface after setting the interval
    header('Location: deploy.php');
    exit();
}

// For a GET request, return the current interval
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($filename)) {
        echo file_get_contents($filename);
    } else {
        // Default to 1 minute if not set
        echo "60000";
    }
}
?>
