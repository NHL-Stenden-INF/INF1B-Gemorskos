<?php
    
require_once "config.php";
require_once "session.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email)) {
        $error .= "<p>Please enter email.</p>";
    }

    if (empty($password)) {
        $error .= "<p>Please enter your password</p>";
    }

    if (empty($error)) {
        if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
            $query->bind_param("s", $email);
            $query->execute();
            $row = $query->fetch();
            if ($row) {
                if (password_verify($password, $row["password"])) {
                    $_SESSION["userid"] = $row["id"];
                    $_SESSION["user"] = $row;

                    header("location: welcome.php");
                    exit;
                } else {
                    $error .= "<p>The password is not valid.</p>";
                }
            } else {
                $error .= "<p>No User exist with that email address.</p>";
            }
        }
        $query->close();
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
    <div class="signin_page">
        <h1>Welkom, Log hier in!</h1>
    </div>
    
    <div class="login">
        <form action="" method="post">
            <div class="login_img">
                <img class="login_img2" src="img/Gemorskos logo wit.png" alt="Logo">
            </div>
        <div class="container">
            <label><b>Email Address</b></label>
            <input type="email" placeholder="Enter Username" name="email" required>
        <br>
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
        <br>
            <input type="submit" name="submit" value="Submit">
        </div>
        <div class="container">
            <p>No <a href="register.php">account?</a></p>
        </div>
        </form>
    </div>
</body>
</html>