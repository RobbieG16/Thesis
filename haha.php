<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Execute Average Daily Script</title>
</head>
<body>
    <h1>Execute Average Daily Script</h1>
    
    <form action="haha.php" method="post">
        <button type="submit">Execute Averaging Script</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'averagedaily1.php';
        include 'averagedaily2.php';
        include 'averagedaily3.php';
        
        echo "<h1>Data Fetch and Insert Status</h1>
        <p>Status: $statusMessage</p>";
    }
    ?>

</body>
</html>
