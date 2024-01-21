<?php
    session_start();
    unset($_SESSION['user'], $_SESSION['userid']);
    header('location: index.php');
?>