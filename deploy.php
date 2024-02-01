<!DOCTYPE html>
<html>
<head>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f4f4f4; /* Light background */
      font-family: 'Arial', sans-serif; /* Modern font */
    }
    .container {
      padding: 20px;
      max-width: 600px; /* Responsive width */
      margin: auto;
      background: white; /* Clear distinction from the background */
      border-radius: 8px; /* Softened edges */
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }
    .custom-range {
      cursor: pointer; /* Indicates interactivity */
    }
    .custom-range:focus {
      outline: none; /* Removes default focus outline */
      box-shadow: none; /* Removes default focus shadow */
    }
    .slider-thumb {
      background: #007bff; /* Bootstrap primary color */
    }
    .output {
      color: #FF0000; 
      font-weight: bold; 
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <?php include('sidebar.php'); ?>

<div class="container">

  <h2 class="text-center mb-4">Micro Controller Settings</h2>
  <!-- Form 1 -->
  <form action="controller.php" method="post" onsubmit="return confirmChange()">
    <label for="interval1 ">Set Reading Micro Controller 1 (1min - 8hrs):</label>
    <input type="range" class="custom-range" id="interval1" name="interval" min="60000" max="28800000" value="60000" 
      oninput="updateOutput(this.value, 'intervalOutput1')">
    <output id="intervalOutput1" class="output">1min</output>
    <input type="submit" class="btn btn-primary mt-2 mb-4" value="Set Interval">
  </form>

  <!-- Form 2 -->
  <form action="controller2.php" method="post" onsubmit="return confirmChange()">
    <label for="interval2">Set Reading Micro Controller 2 (1min - 8hrs):</label>
    <input type="range" class="custom-range" id="interval2" name="interval" min="60000" max="28800000" value="60000" 
      oninput="updateOutput(this.value, 'intervalOutput2')">
    <output id="intervalOutput2" class="output">1min</output>
    <input type="submit" class="btn btn-primary mt-2 mb-4" value="Set Interval">
  </form>

  <!-- Form 3 -->
  <form action="controller3.php" method="post" onsubmit="return confirmChange()">
    <label for="interval3">Set Reading Micro Controller 3 (1min - 8hrs):</label>
    <input type="range" class="custom-range" id="interval3" name="interval" min="60000" max="28800000" value="60000" 
      oninput="updateOutput(this.value, 'intervalOutput3')">
    <output id="intervalOutput3" class="output">1min</output>
    <input type="submit" class="btn btn-primary mt-2 mb-4" value="Set Interval">
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
// JavaScript Function to update the output based on slider value
function updateOutput(val, outputId) {
  var output = document.getElementById(outputId);
  var hours = Math.floor(val / 3600000);
  var minutes = Math.floor((val % 3600000) / 60000);
  output.value = hours > 0 ? (hours + "hr" + (minutes > 0 ? " " + minutes + "min" : "")) : minutes + "min";
}

// Function to confirm the interval change
function confirmChange() {
  return confirm("Are you sure you want to set the interval?");
}
</script>

</body>
</html>
<style>
.btn-primary{
  margin-left: 180px;
}

</style>