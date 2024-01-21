<?php

include "db_userconnection.php";
include "session.php";

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    //decoding html form
    $fullname = htmlspecialchars(filter_input(INPUT_POST, 'name'));
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $confirm_password = filter_input(INPUT_POST, 'confirm_password');
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    //db stuff
    try {
        $checkQuery = $dbHandler->prepare("SELECT * FROM users WHERE email = :email");
        $checkQuery->bindParam(':email', $email);
        $checkQuery->execute();
        $result = $checkQuery->fetch(PDO::FETCH_ASSOC);
        //checking for password and stuffs
        if ($result) {
            $error = '<p>The email address is already registered!</p>';
        } else {
            if (strlen($password) < 6) 
            {
                $error = "<p>Password must have at least 6 characters.</p>";
            } 
            elseif (empty($confirm_password)) 
            {
                $error = "<p>Please enter confirm password.</p>";
            } 
            elseif ($password != $confirm_password) 
            {
                $error = "<p>Passwords do not match.</p>";
            } 
            else 
            {
                //actually putting it into the db
                $insertQuery = $dbHandler->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password);");
                $insertQuery->bindParam(':name', $fullname);
                $insertQuery->bindParam(':email', $email);
                $insertQuery->bindParam(':password', $password_hash);
                $result = $insertQuery->execute();
                //display status to user
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
            <?php
                echo $error;
            ?>
        </form>
    </div>
</body>
</html>