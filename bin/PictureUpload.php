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

        $response = array(
            "status" => "alert-danger",
            "message" => "Unknown error"
        );

        // Set image placement folder
        $target_dir = "C:/Users/math864n/Desktop/" . $name."/";
        // Allowed file types
        $allowedFileType = array("jpg", "jpeg", "png");


        // Velidate if files exist
        if (!empty(array_filter($_FILES['fileUpload']['name']))) {

            // Loop through file items
            foreach($_FILES['fileUpload']['name'] as $id=>$val){

                // Get files upload path
                $path_parts = pathinfo($_FILES['fileUpload']['name'][$id]);
                $fileName = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
                $tempLocation    = $_FILES['fileUpload']['tmp_name'][$id];
                $targetFilePath  = $target_dir . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $uploadDate      = date('Y-m-d H:i:s');

                if(in_array($fileType, $allowedFileType)){
                    if(move_uploaded_file($tempLocation, $targetFilePath)){
                        $sqlVal = "('".$fileName."', '".$uploadDate."')";
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "File coud not be uploaded."
                        );
                    }

                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Only .jpg, .jpeg and .png file formats allowed."
                    );
                }
                // Add into MySQL database
                if(!empty($sqlVal)) {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "success"
                    );
                    /*$insert = $conn->query("INSERT INTO user (images, date_time) VALUES $sqlVal");
                    if($insert) {
                        $response = array(
                            "status" => "alert-success",
                            "message" => "Files successfully uploaded."
                        );
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "Files coudn't be uploaded due to database error."
                        );
                    }*/
                }
            }

        } else {
            // Error
            $response = array(
                "status" => "alert-danger",
                "message" => "Please select a file to upload."
            );
        }


        return $response;
    }




}