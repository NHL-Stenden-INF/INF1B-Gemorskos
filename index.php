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
        <form action="" method="post">
            <div class="login_img">
                <img class="login_img2" src="img/Gemorskos logo wit.png" alt="Logo">
            </div>
        <div class="container">
            <label for="uname"><b>Email Address</b></label>
            <input type="email" placeholder="Enter Username" name="email" required>
            <br>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <br>
            <input type="submit" name="submit" value="Submit">
        </div>
        <div class="container">
            <button class="cancelbtn" type="button">Cancel</button>
            <span class="psw">No <a href="register.php">account?</a></span>
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