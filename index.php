<?php
    include 'db_userconnection.php';
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
        <form action="action_page.php" method="post">
            <div class="login_img">
                <img class="login_img2" src="img/Gemorskos logo wit.png" alt="Logo">
            </div>
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <br>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <br>
            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>
        <div class="container">
            <button class="cancelbtn" type="button">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
        </form>
    </div>
    <div>
        <p>Test connectie</p>
        <?php
            echo $log;
        ?>
    </div>
</body>
</html>