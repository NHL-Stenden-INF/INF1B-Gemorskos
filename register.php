<?php

require_once "db_userconnection.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
        $error = '';
    $query->bind_param('s', $email);
    $query->execute();
    $query->store_result();
        if ($query->num_rows > 0) {
            $error .= '<p>The email address is already registerd!</p>';
        } else {
            if (strlen($password) < 6) {
                $error.= "<p>Password must have atleast 6 charactesr.</p>";
            }

            if (empty($confirm_password)) {
                $error.= "<p>Please enter confirm password.</p>";
            } else {
                if (empty($error) && ($password != $confirm_password)) {
                    $error .= "<p>Password dit not match.</p>"
                }
            }
            if (empty($error)) {
                $insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?);");
                $insertQuery->bind_param("sss", $fullname, $email, $password_hash);
                $result = $insertQuery->execute();
                if ($result) {
                    $error .= "<p>Your registration was successful!</p>";
                } else {
                    $error .= "<p>Something went wrong!</p>"
                }
            }
        }
    }
    $query->close();
    $insertQuery->close();
    #mysqli_close($db) Niet voor ons, ivm PDO
}

?>