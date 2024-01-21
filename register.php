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
                    $error .= "<p>Password dit not match.</p>";
                }
            }
            if (empty($error)) {
                $insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?);");
                $insertQuery->bind_param("sss", $fullname, $email, $password_hash);
                $result = $insertQuery->execute();
                if ($result) {
                    $error .= "<p>Your registration was successful!</p>";
                } else {
                    $error .= "<p>Something went wrong!</p>";
                }
            }
        }
    }
    $query->close();
    $insertQuery->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemorskos</title>
</head>
<body>
    <header class="header">
        <div>
            <img class="foto" src="img/Gemorskos logo zwart.png" alt="Logo">
        </div>
    </header>
    <div>
        <h2>Register</h2>
        <p>Please fill in this form to create an account.</p>
        <form action="" method="post">
            <label>Full Name</label>
            <input type="text" name="name" required><br>
            <label>Email Address</label>
            <input type="email" name="email" required><br>
            <label>Password</label>
            <input type="password" name="password" required><br>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required><br>
            <input type="submit" name="submit" value="Submit">
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>