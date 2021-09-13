<?php
$allowedFileType = array("jpg", "jpeg", "png", "jfif", "pjpeg", "pjp", "svg", "gif");
class Galleri
{
    /**
     * Uploads picture
     *
     * @param string $category
     * @param bool $frontpageEnabled
     * @param string $title
     * @param string $date
     * @return string[]
     */
    function Upload(string $category, bool $frontpageEnabled, string $title = "", string $date = ""): array
    {
        if ($category == "")
            $category = "Galleri";
        if ($date =="")
            $date = date('Y-m-d');

        $category = ucfirst(strtolower($category));

        // Database connection
        global $conn;

        $response = array(
            "status" => "alert-danger",
            "message" => "Ukendt fejl"
        );

        // Where image is stored
        $target_dir = "../../billeder/".$category."/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir);
        }

        if($category != "") {
            if ($conn) {
                // Gets the id of the current category
                $sql = "SELECT id FROM categories WHERE category =?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();
                if (!$categoryID = $result->fetch_assoc()) {
                    $stmt = $conn->prepare("INSERT INTO categories(category) VALUES (?)");
                    $stmt->bind_param("s", $category);
                    $stmt->execute();
                    $categoryID = mysqli_insert_id($conn);
                } else {
                    $categoryID = $categoryID['id'];
                }
            }
        }



        // Allowed file types
        global $allowedFileType;


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
                    $date  = date('Y-m-d', strtotime($date));
                    $stmt = $conn->prepare("INSERT INTO pictures (title, path, date, frontpageEnabled, category) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssii", $title, $fileName, $date, $frontpageEnabled, $categoryID);
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
            $sql = "SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id ORDER BY pictures.date DESC;" ;

            $result = $conn->query($sql);
            if($result){
                $pictures=$result->fetch_all(MYSQLI_ASSOC);
            }
        }


        return $pictures;
    }

    /**
     * gets all images sorted by category
     * @param string $date
     * @return array
     */
    function LoadOrderByCategories(string $date):array
    {
        $pictures = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id WHERE YEAR(date) = ? ORDER BY pictures.category DESC;");
            $sql->bind_param("s", $date);
            if ($sql->execute()){
                $result = $sql->get_result();
                $pictures = $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return $pictures;
    }

    /**
     * Gets Gets all images by their year
     * @param string $date
     * @return array
     */
    function LoadSpecificYear(string $date):array
    {
        $pictures = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id WHERE YEAR(date) = ? ;");
            $sql->bind_param("s", $date);
            if ($sql->execute()){
                $result = $sql->get_result();
                $pictures = $result->fetch_all(MYSQLI_ASSOC);
            }
        }

        return $pictures;
    }

    /**
     * Gets all images by their category
     * @param string $category
     * @return array
     */
    function LoadSpecificCategory(string $category):array
    {
        $pictures = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id WHERE categories.category = ? ;");
            $sql->bind_param("s", $category);
            if ($sql->execute()){
                $result = $sql->get_result();
                $pictures = $result->fetch_all(MYSQLI_ASSOC);
            }
        }

        return $pictures;
    }

    /**
     * Gets all images by their category and title
     * @param string $date
     * @param string $category
     * @return array
     */
    function LoadSpecific(string $date,string $category):array
    {
        $pictures = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id WHERE categories.category = ? AND YEAR(date) = ? ;");
            $sql->bind_param("ss", $category, $date);
            if ($sql->execute()){
                $result = $sql->get_result();
                $pictures = $result->fetch_all(MYSQLI_ASSOC);
            }
        }

        return $pictures;
    }

    /**
     * Gets a single row from the database
     *
     * @param int $id
     * @return bool|string
     */
    function LoadSingle(int $id): bool|string
    {
        $member = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id WHERE pictures.id =?;");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                $result = $sql->get_result();
                $member = $result->fetch_assoc();
            }
        }
        return json_encode($member);
    }

    /**
     * Deletes image from database and server
     *
     * @param int $id  The id of the picture
     * @return bool
     */
    function Delete(int $id) : bool
    {
        $removed = false;
        global $conn;
        $picture = "";
        $category = "";

        $sql = "SELECT pictures.path, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id WHERE pictures.id =?;";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $tmp = $stmt->get_result();
        if($result=$tmp->fetch_assoc()){
            $picture = $result['path'];
            $category = $result['category'];
        }

        $path = "../../billeder/".$category."/".$picture;

        if(unlink(realpath($path))){
            $sql = "DELETE FROM pictures WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            echo "file removed";
            $removed = true;
        }
        return $removed;
    }

    /**
     * Updates specific image
     * @param int $id
     * @param string $title
     * @param string $category
     * @param string $date
     * @param string $imgPath
     * @param $fileUpload
     * @param bool $frontpageEnabled
     * @return string[]
     */
    function Update(int $id, string $title, string $category, string $date, string $imgPath, $fileUpload, bool $frontpageEnabled) :array
    {

        if ($frontpageEnabled){
            $frontpageEnabled = 1;
        }
        else{
            $frontpageEnabled = 0;
        }

        $category = ucfirst(strtolower($category));

        // Database connection
        global $conn;

        $response = array(
            "status" => "alert-danger",
            "message" => "Ukendt fejl"
        );

        // Where image is stored
        $target_dir = "../../billeder/".$category."/";

        if($category != "") {
            if ($conn) {
                // Gets the id of the current category
                $sql = "SELECT id FROM categories WHERE category =?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();
                if (!$categoryID = $result->fetch_assoc()) {
                    $stmt = $conn->prepare("INSERT INTO categories(category) VALUES (?)");
                    $stmt->bind_param("s", $category);
                    $stmt->execute();
                    $categoryID = mysqli_insert_id($conn);
                } else {
                    $categoryID = $categoryID['id'];
                }
            }
        }


        if(file_exists($target_dir.$imgPath)){
            $date  = date('Y-m-d', strtotime($date));
            $stmt = $conn->prepare("UPDATE pictures SET title=?, path=?, date=?, frontpageEnabled =?,  category=? WHERE id = ?");
            $stmt->bind_param("sssiii", $title, $imgPath, $date, $frontpageEnabled, $categoryID, $id);
            if($stmt->execute()) {
                $response = array(
                    "status" => "alert-success",
                    "message" => "Filerne blev updateret."
                );
            } else {
                $response = array(
                    "status" => "alert-danger",
                    "message" => "Filerne kunne ikke updateret pga. database fejl."
                );
            }
            return $response;
        }
        else {
            $sql = "SELECT pictures.path, categories.category FROM pictures INNER JOIN categories ON pictures.category = categories.id WHERE pictures.id =?;";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $picture = $result->fetch_assoc();
            $path = "../../billeder/".$picture['category']."/".$picture['path'];

            unlink(realpath($path));

            if(!file_exists($target_dir))
                mkdir($target_dir);
        }

        // Allowed file types
        global $allowedFileType;


        // Validate if files exist
        if (!empty($imgPath)) {

            // Get files upload path
            $path_parts = explode(".", $imgPath, 2);
            $fileName = $path_parts[0].'_'.time().'.'.$path_parts[1];
            $tempLocation    = $fileUpload['fileUpload']['tmp_name'][0];
            $targetFilePath  = $target_dir . $fileName;
            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $uploadDate      = date('Y-m-d H:i:s');

            if(in_array($fileType, $allowedFileType)){
                if(move_uploaded_file($tempLocation, $targetFilePath)){
                    $sqlVal = "('".$fileName."', '".$uploadDate."')";
                }
            }
            // Add into MySQL database
            if(!empty($sqlVal)) {
                $date  = date('Y-m-d', strtotime($date));
                $stmt = $conn->prepare("UPDATE pictures SET title=?, path=?, date=?, frontpageEnabled =?, category=? WHERE id = ?");
                $stmt->bind_param("sssiii", $title, $fileName, $date, $frontpageEnabled, $categoryID, $id);
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

            else{
                $response = array(
                    "status" => "alert-success",
                    "message" => "Filerne blev uploadet."
                );
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