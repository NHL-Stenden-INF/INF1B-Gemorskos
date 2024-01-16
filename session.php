<?php
//Start the session
session_start();

//If user is logged in then redirect to home page
if (isset($_SESSION["userid"]) && $_SESSION["userid"] === true){
    header("location: session.php");
    exit;
}
?>