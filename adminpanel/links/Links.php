<?php

class Links
{
    /**
     * Gets all links from database
     * @return array
     */
    static function Load():array
    {
        $admins = array();
        global $conn;
        if ($conn) {
            $sql = "SELECT * FROM links" ;
            $result = $conn->query($sql);
            if($result){
                $admins=$result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return $admins;
    }

    /**
     * Gets single link
     * @param $id
     * @return array
     */
    static function LoadSingle($id):array
    {
        $admin = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM links WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                $result = $sql->get_result();
                $admin = $result->fetch_assoc();
            }
        }
        return $admin;
    }

    /**
     * Deletes given link
     * @param $id
     * @return string[]
     */
    static function Delete($id):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;

        if ($conn) {
            $sql = $conn->prepare("DELETE FROM links WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                $response = array(
                    "status" => "success",
                    "message" => "Bruger slettet"
                );
            }else{
                $response = array(
                    "status" => "error",
                    "message" => "Der skete en fejl med databasen"
                );
            }
        }
        return $response;
    }

    /**
     * Updates selected link, returns response
     * @param $id
     * @param $title
     * @param $path
     * @return string[]
     */
    static function Update($id, $title, $path):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
            if ($conn) {
                $sql = $conn->prepare("UPDATE links SET title=?, link_path=? WHERE id=?");
                $sql->bind_param("ssi", $title, $path, $id);
                if ($sql->execute())
                    $response = array(
                        "status" => "success",
                        "message" => "Link opdateret"
                    );
                else
                    $response = array(
                        "status" => "error",
                        "message" => "Der skete en fejl med databasen"
                    );
            }

        return $response;
    }

    /**
     * Creates a new link
     * @param $title
     * @param $path
     * @return string[]
     */
    static function Create($title, $path):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;

        $sql = $conn->prepare("INSERT INTO links (title, link_path) VALUES (?,?)");
        $sql->bind_param("ss", $title, $path);
        if ($sql->execute())
            $response = array(
                "status" => "success",
                "message" => "Link lavet"
            );
        else
            $response = array(
                "status" => "error",
                "message" => "Der skete en fejl med databasen"
            );

        return $response;
    }
}