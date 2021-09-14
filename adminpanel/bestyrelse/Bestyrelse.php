<?php

class Bestyrelse
{
    /**
     * Gets everything from members database
     * @return array|mixed
     */
    static function Load()
    {
        $members = array();
        global $conn;
        if ($conn) {
            $sql = "SELECT * FROM members" ;
            $result = $conn->query($sql);
            if($result){
                $members=$result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return $members;
    }

    /**
     * Gets a single member from database
     * @param int $id
     * @return false|string
     */
    static function LoadSingle(int $id)
    {
        $member = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM members WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                $result = $sql->get_result();
                $member = $result->fetch_assoc();
            }
        }
        return json_encode($member);
    }

    /**
     * Delete a member from the database, and their image
     * @param int $id
     * @return string[]
     */
    static function Delete(int $id):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;

        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM members WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) {
                    if ($row['picture_path']=="bestyrelseDefault.png")
                        continue;
                    unlink('../../billeder/bestyrelse/' . $row['picture_path']);
                }
            }else{
                $response = array(
                    "status" => "error",
                    "message" => "Kunne ikke finde bestyrelsesmedlemet i databasen"
                );
            }
        }

        if ($conn) {
            $sql2 = $conn->prepare("DELETE FROM members WHERE id=?");
            $sql2->bind_param("i", $id);
            if ($sql2->execute()){
                $response = array(
                    "status" => "success",
                    "message" => "Bestyrelsesmedlem slettet"
                );
            }else{
                $response = array(
                    "status" => "error",
                    "message" => "Kunne ikke slette fra databasen"
                );
            }
        }
        return $response;
    }

    /**
     * Updates a member in the database
     * @param int $id
     * @param string $name
     * @param string $title
     * @param string $picture_path
     * @param int $phoneNumber
     * @param string $email
     * @return string[]
     */
    static function Update(int $id, string $name, string $title, string $picture_path,int $phoneNumber,string $email):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        if ($phoneNumber == "" || $phoneNumber == 0)
            $phoneNumber = NULL;

        if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["name"] != null) {
            if ($conn) {
                $sql = $conn->prepare("SELECT * FROM members WHERE id=?");
                $sql->bind_param("i", $id);
                if ($sql->execute()) {
                    $result = $sql->get_result();
                    while ($row = $result->fetch_assoc()) {
                        if ($row['picture_path'] == "bestyrelseDefault.png")
                            continue;
                        unlink('../../billeder/bestyrelse/' . $row['picture_path']);
                    }
                } else {
                    $response = array(
                        "status" => "error",
                        "message" => "Kunne ikke finde bestyrelsesmedlemet i databasen"
                    );
                }
            }

            $temp = explode(".", $_FILES["fileUpload"]["name"]);
            $picture_path = round(microtime(true)) . '.' . end($temp);


            $location = "../../billeder/bestyrelse/" . $picture_path;


            if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $location)) {

                $response = array(
                    "status" => "success",
                    "message" => "Billede tilføjet til serveren"
                );
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Kunne tilføje billedet til serveren"
                );
            }
        }


        if (!isset($_FILES["fileUpload"]))
            $picture_path = "bestyrelseDefault.png";

        if ($conn) {
            $sql = $conn->prepare("UPDATE members SET fullname=?, title=?, picture_path=?, phonenumber=?, email=? WHERE id=?");
            $sql->bind_param("sssisi", $name, $title, $picture_path, $phoneNumber, $email, $id);
            if ($sql->execute()){
                $response = array(
                    "status" => "success",
                    "message" => "Bestyrelsesmedlem opdateret"
                );
            }else{
                $response = array(
                    "status" => "error",
                    "message" => "Kunne ikke opdatere bestyrelsesmedlemmet"
                );
            }
        }
        return $response;
    }

    /**
     * Creates a new member in the database and uploads their image
     * @param string $name
     * @param string $title
     * @param int $phoneNumber
     * @param string $email
     * @return string[]
     */
    static function Create(string $name,string $title,int $phoneNumber,string $email):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;

        if ($phoneNumber == "" || $phoneNumber == 0)
            $phoneNumber = NULL;

        $temp = explode(".", $_FILES["fileUpload"]["name"]);
        $filename = round(microtime(true)) . '.' . end($temp);

        if (!isset($_FILES["fileUpload"]))
            $filename = "bestyrelseDefault.png";

        $location = "../../billeder/bestyrelse/".$filename;


        if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $location)){
            $response = array(
                "status" => "success",
                "message" => "Billede tilføjet til serveren"
            );
        } else {
            $response = array(
                "status" => "error",
                "message" => "Kunne tilføje billedet til serveren"
            );
        }


        if ($conn) {
            $sql = $conn->prepare("INSERT INTO members (fullname, title, picture_path, phonenumber, email) VALUES (?,?,?,?,?)");
            $sql->bind_param("sssis", $name, $title, $filename, $phoneNumber, $email);
            if ($sql->execute()){
                $response = array(
                    "status" => "success",
                    "message" => "Bestyrelsesmedlem tilføjet til databasen"
                );
            }else{
                $response = array(
                    "status" => "error",
                    "message" => "Kunne ikke tilføje bestyrelsesmedlemmet til databasen"
                );
            }
        }
        return $response;
    }

}