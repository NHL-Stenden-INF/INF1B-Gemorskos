<?php

$host = "127.0.0.1";
$dbname= "gemorskos_users";
$username = "root";
$password = "1234";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST["submit"])) {
    $image_folder = "uploads/";

    if(!file_exists($image_folder)) {
        mkdir($image_folder, 0755, true);
    }

    $uploadedImages = array();
    $numFiles = count($_FILES["image"]["name"]);

    for ($i = 0; $i < $numFiles; $i++) {
        $image_name = $_FILES["image"]["name"][$i];
        $image_tmp = $_FILES["image"]["tmp_name"][$i];
        $image_path = $image_folder . $image_name;

        if(move_uploaded_file($image_tmp, $image_path)) {
            $uploadedImages[] = array("name" => $image_name, "path" => $image_path);
        } else {
            echo "Error uploading image $image_name. Check the destination folder permissions.";
        }
    }

    if(!empty($uploadedImages)) {
        try{
            $query = "INSERT INTO images (image_name, image_path) VALUES (:image_name, :image_path)";
            $stmt = $conn->prepare($query);

            foreach ($uploadedImages as $image) {
                $stmt->bindParam(":image_name", $image['name']);
                $stmt->bindParam(":image_path", $image['path']);
                if(!$stmt->execute()) {
                    echo "Image uploaded but did not save successfully!";
                }
            }
            
            echo "Images uploaded and saved successfully!";

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>