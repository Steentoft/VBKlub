<?php

class Pictures
{
    /**
     * Upload image file to given folder.
     *
     * @param string $category  The category where the pictures belong
     * @param bool $uploadDatabase  Default true, uploads path to database
     * @param string $title  Optional title of picture
     *
     * @return array responseMessage
     */
    function Upload(string $category,bool $uploadDatabase = true, string $title = ""): array
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

        if ($conn) {
            // Gets the id of the current category
            $sql = "SELECT id FROM categories WHERE category ='" . $category. "'" ;

            $result = $conn->query($sql);
            $tmp = $result->fetch_assoc();
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
                if ($uploadDatabase){
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
                else{
                    $response = array(
                        "status" => "alert-success",
                        "message" => "Filerne blev uploadet."
                    );
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


    /**
     * Gets all images from database.
     *
     * @return array all info regarding pictures
     */
    function Load(): array
    {
        $pictures = array();
        global $conn;
        if ($conn) {
            $sql = "SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id;" ;

            $result = $conn->query($sql);
            if($result){
                $pictures=$result->fetch_all(MYSQLI_ASSOC);
            }
        }


        return $pictures;
    }

    /**
     * Deletes image from database and server
     *
     * @param int $id  The id of the picture
     *
     */
    function Delete(int $id){
        global $conn;
        $picture = array();
        $sql = "SELECT pictures.path FROM pictures";

        $result = $conn->query($sql);
        if($result){
            $picture=$result->fetch_all(MYSQLI_ASSOC);
        }

        $sql = "DELETE FROM pictures WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $path = "/../".$picture[0]['path'];
        unlink($path);

    }

}