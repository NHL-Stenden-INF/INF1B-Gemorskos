<?php
    $dbhost = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "1234";
    $dbname = "gemorskos_users";
    // remove before pushing
    // $dbhost = 'mysql';
    // $dbpass = 'qwerty';
    try
    {
        $dbHandler = new PDO ("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $log = 'Connected to db';
    }
    catch(PDOException $ex)
    {
        echo $ex;
        $log = 'failed to connect';
    };
?>