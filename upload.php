<?php

// $host = "127.0.0.1";
// $dbname= "gemorskos_users";
// $username = "root";
// $password = "1234";

// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }

// if(isset($_POST["submit"])) {
//     $image_folder = "uploads/";

//     // if(!file_exists($image_folder)) {
//     //     mkdir($image_folder, 0755, true);
//     // }

//     var_dump($_FILES);
//     $uploadedImages = array();
//     $numFiles = count($_FILES["image"]["name"]);

//     for ($i = 0; $i < $numFiles; $i++) {
//         $image_name = $_FILES["image"]["name"][$i];
//         $image_tmp = $_FILES["image"]["tmp_name"][$i];
//         $image_path = $image_folder . $image_name;

//         if(move_uploaded_file($image_tmp, $image_path)) {
//             $uploadedImages[] = array("name" => $image_name, "path" => $image_path);
//         } else {
//             echo "Error uploading image $image_name. Check the destination folder permissions.";
//         }
//     }

//     if(!empty($uploadedImages)) {
//         try{
//             $query = "INSERT INTO images (image_name, image_path) VALUES (:image_name, :image_path)";
//             $stmt = $conn->prepare($query);

//             foreach ($uploadedImages as $image) {
//                 $stmt->bindParam(":image_name", $image['name']);
//                 $stmt->bindParam(":image_path", $image['path']);
//                 if(!$stmt->execute()) {
//                     echo "Image uploaded but did not save successfully!";
//                 }
//             }
            
//             echo "Images uploaded and saved successfully!";

//         } catch(PDOException $e) {
//             echo "Error: " . $e->getMessage();
//         }
//     }
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];
        $allowedExtensions = array("png", "jpeg", "jpg", "gif");
        $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Invalid file type");
        }
        if ($file['size'] > 3 * 1024 * 1024) {
            die("Your file is bigger then 3mb");
        }
        // !preg_match checks if your file name do not matches the characters you specify on the left.
        if(strlen($file["name"]) > 50 || !preg_match('/[A-Z]/', $file["name"])) {
            die("File name too long or you need atleast one uppercase letter.");
        }
        $uploadPath = "upload/";
        $newFilename = $file["name"];
        // combines our made variables into 1 new variable so it automaticly places the upload path before the name to store it correctly.
        $destination = $uploadPath . $newFilename;

        // move the file from the temporary location and temporary name to our new place, uploads/ wich we can find in the root.
        if (move_uploaded_file($file["tmp_name"], $destination)) 
		{
            // fires code when the file got moved to the destination.
            echo "File uploaded successfully!<br>";
        } else {
            // fires code when the file did NOT moved to the destination.
            echo "File upload failed.";
        }

    }
    else {
        echo "No file uploaded.";
    }
}

?>