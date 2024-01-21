<?php

require_once "db_userconnection.php";
require_once "session.php";

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    try {
        $checkQuery = $dbHandler->prepare("SELECT * FROM users WHERE email = ?");
        $checkQuery->bindParam(1, $email);
        $checkQuery->execute();
        $result = $checkQuery->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $error = '<p>The email address is already registered!</p>';
        } else {
            if (strlen($password) < 6) {
                $error = "<p>Password must have at least 6 characters.</p>";
            } elseif (empty($confirm_password)) {
                $error = "<p>Please enter confirm password.</p>";
            } elseif ($password != $confirm_password) {
                $error = "<p>Passwords do not match.</p>";
            } else {
                $insertQuery = $dbHandler->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?);");
                $insertQuery->bindParam(1, $fullname);
                $insertQuery->bindParam(2, $email);
                $insertQuery->bindParam(3, $password_hash);
                $result = $insertQuery->execute();

                if ($result) {
                    $error = "<p>Your registration was successful!</p>";
                } else {
                    $error = "<p>Something went wrong!</p>";
                }

                $insertQuery->closeCursor();
                $checkQuery->closeCursor();
            }
        }

        $checkQuery->closeCursor();
    } catch (PDOException $e) {
        // Log the error
        error_log("Database Error: " . $e->getMessage(), 0);
    
        // Provide a user-friendly message
        $error = "<p>Something went wrong with the database. Please try again later.</p>";
    }
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
        <form action="register.php" method="post">
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