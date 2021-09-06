<?php

class PictureUpload
{
    /**
     * Upload image file to given folder.
     *
     * @param Foldername   $name  Where the file should be uploaded to
     *
     * @author MathiasDuus <github.com/MathiasDuus>
     * @return array responseMessage
     */
    static function Upload($name)
    {
        // Database connection
        //include_once("config/database.php");

        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Image coudn't be uploaded."
        );

        if(isset($_POST["submit"])) {
            // Set image placement folder
            $target_dir = "C:/Users/math864n/Desktop/" . $name;
            $target_dir = "C:\Users\math864n\Desktop\pictureUpload/";
            // Get file path
            $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
            // Get file extension
            $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Allowed file types
            $allowd_file_ext = array("jpg", "jpeg", "png");


            if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {
                $resMessage = array(
                    "status" => "alert-danger",
                    "message" => "Select image to upload."
                );
            } else if (!in_array($imageExt, $allowd_file_ext)) {
                $resMessage = array(
                    "status" => "alert-danger",
                    "message" => "Allowed file formats .jpg, .jpeg and .png."
                );
            } else if ($_FILES["fileUpload"]["size"] > 2097152) {
                $resMessage = array(
                    "status" => "alert-danger",
                    "message" => "File is too large. File size should be less than 2 megabytes."
                );
            } else if (file_exists($target_file)) {
                $resMessage = array(
                    "status" => "alert-danger",
                    "message" => "File already exists."
                );
            } else {
                if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                    $sql = "INSERT INTO user (file_path) VALUES ('$target_file')";
                    $stmt = "";//$conn->prepare($sql);
                    if(/*$stmt->execute() ||*/ true){
                        $resMessage = array(
                            "status" => "alert-success",
                            "message" => "Image uploaded successfully."
                        );
                    }
                } else {
                    $resMessage = array(
                        "status" => "alert-danger",
                        "message" => "Image coudn't be uploaded."
                    );
                }
            }

        }
        return $resMessage;
    }




}