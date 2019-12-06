<?php

// https://www.w3schools.com/php/php_file_upload.asp
// https://antoine-herault.developpez.com/tutoriels/php/upload/
// https://www.damienflandrin.fr/blog/post/tutoriel-comment-uploader-un-fichier-en-php

    class ImageUploader {

        public static function uploadImg() {

            $target_dir = "../images/";

            $target_file = $target_dir . basename($_FILES['img']['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

/*
            // check if the image file is an actual image or fake image
            if(Routeur::myGet('submit') !== NULL) {
                echo '1';
                $check = getimagesize($_FILES['img']['tmp_name']);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo '2';
                    echo "File is not an image";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES['img']['size'] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

*/
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
//                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
           } else {
                if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                    echo "The file ". basename($_FILES['img']['name']). " has been uploaded.";
                } else {
//                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

?>

