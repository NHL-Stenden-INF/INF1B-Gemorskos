<?php
session_start();

if (!isset($_SESSION["userid"]) || $_SESSION["userid"] !== true) {
    header ("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>U bent ingelogd!</p>
</body>
</html>