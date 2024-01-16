<?php
function OpenCon(){
    $dbhost = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "1234";
    $dbname = "gemorskos_users";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Connection Failed: %s\n". $conn -> error);
    return $conn;
}
function CloseCon($conn){
    $conn -> close();
}
?>