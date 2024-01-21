<?php
$host = "127.0.0.1";
$dbname = "gemorskos_users";
$username = "root";
$password = "1234";

try {
    $dbHandler = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>