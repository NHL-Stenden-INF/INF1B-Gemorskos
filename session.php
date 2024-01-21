<?php
// Start the session
session_start();

// If the user is already logged in, redirect to the home page
if (isset($_SESSION["userid"]) && $_SESSION["userid"] !== null) {
    header("location: welcome.php");
    exit;
}
?>
