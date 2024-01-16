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
        }
    }
}

?>