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