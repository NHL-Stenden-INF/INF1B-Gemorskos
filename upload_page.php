<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form pagina</title>
</head>
<body>
<header class="header">
    <div>
        <div>
            <h1>Upload pagina!</h1>
        </div>
        <div class="link_header">
            <a href="index.php">Home</a>
        </div>
    </div>
</header>
    <form class="form" action="upload.php" method="post" enctype="multipart/form-data">
        <p>Select image to upload:</p>
        <input type="file" name="image[]" multiple><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>