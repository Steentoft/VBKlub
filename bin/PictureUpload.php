<?php

class PictureUpload
{
    /**
     * Upload image file to given folder.
     *
     * @param string $category  The category where the pictures belong
     * @param string $title  Optional title of picture
     *
     * @return array responseMessage
     *@author MathiasDuus <github.com/MathiasDuus>
     */
    static function Upload(string $category,string $title = ""): array
    {
        $categoryID ="helo";
        // Database connection
        global $conn;

        $response = array(
            "status" => "alert-danger",
            "message" => "Ukendt fejl"
        );

        // Set image placement folder
        $target_dir = "billeder/" . $category."/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir);
        }

        if (true) {
            // Gets the id of the current category
            $sql = "SELECT id FROM categories WHERE category ='" . $category. "'" ;

            $result = $conn->query($sql);
            $tmp = $result->fetch_assoc();
            var_dump($tmp);
            $categoryID = $tmp['id'];
        }



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
                            "message" => "Filen kunne ikke uploades."
                        );
                    }

                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Kun .jpg, .jpeg og .png filer er tilladte."
                    );
                }
                // Add into MySQL database
                if(!empty($sqlVal)) {
                    $date  = date('Y-m-d');
                    $stmt = $conn->prepare("INSERT INTO pictures (title, path, date, category) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("sssi", $title, $targetFilePath, $date, $categoryID);
                    if($stmt->execute()) {
                        $response = array(
                            "status" => "alert-success",
                            "message" => "Filerne blev uploadet."
                        );
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "Filerne kunne ikke uploades pga. database fejl."
                        );
                    }
                }
            }

        } else {
            // Error
            $response = array(
                "status" => "alert-danger",
                "message" => "Vælg venligst en fil at uploade."
            );
        }


        return $response;
    }




}