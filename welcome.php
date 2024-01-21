<?php
session_start();

if (!isset($_SESSION["userid"]) || $_SESSION["userid"] === null) {
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
    <p>U bent ingelogd als <b><?php echo $_SESSION['user']['name']; ?></b>! <br>Met als email adress <b><?php echo $_SESSION['user']['email']; ?></b></p>
    <a href="logout.php">Uitloggen</a>
</body>
</html>