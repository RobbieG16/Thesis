<!DOCTYPE html>
<html>
<head>
    <title>ngiwat</title>
</head>
<body>

<?php
// Disable output buffering
ob_end_flush();
?>

<script>
function runPythonScript() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('output').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'script.php', true);
    xhr.send();
}
</script>  

<button onclick='runPythonScript()'>Run Python Script</button>
<h2>ngiwat Results</h2>
<div id='output'></div>

</body>
</html>
