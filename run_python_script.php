<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Executing PHP script...<br>";

// Specify the full path to the Python executable
$pythonCommand = 'C:\Users\neong\AppData\Local\Programs\Python\Python310\python.exe';

// Execute Python script and capture its output
$pythonScriptPath = "./Hybrid_prediction.py";
$pythonOutput = shell_exec("$pythonCommand $pythonScriptPath 2>&1");

// Display Python script output
echo "<pre>$pythonOutput</pre>";
?>