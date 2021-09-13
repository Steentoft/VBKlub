<?php

class Admins
{
    static function Load()
    {
        $admins = array();
        global $conn;
        if ($conn) {
            $sql = "SELECT * FROM administrators" ;
            $result = $conn->query($sql);
            if($result){
                $admins=$result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return $admins;
    }

    static function LoadSingle($id)
    {
        $member = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM administrators WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                $result = $sql->get_result();
                $admin = $result->fetch_assoc();
            }
        }
        return json_encode($admin);
    }

    static function Delete($id)
    {
        global $conn;

        if ($conn) {
            $sql2 = $conn->prepare("DELETE FROM administrators WHERE id=?");
            $sql2->bind_param("i", $id);
            if ($sql2->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
    }

    /**
     * Updates selected admin, returns response
     * @param $id
     * @param $username
     * @param $password
     * @return string[]
     */
    static function Update($id, $username, $password):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        if (self::checkUsername($username)){
            $response = array(
                "status" => "error",
                "message" => "Brugernavnet findes, vælg venligst et andet"
            );
        }else {
            if ($conn) {
                $sql = $conn->prepare("UPDATE administrators SET username=?, password=? WHERE id=?");
                $sql->bind_param("ssi", $username, $hashedPassword, $id);
                if ($sql->execute())
                    $response = array(
                        "status" => "success",
                        "message" => "Bruger opdateret"
                    );
                else
                    $response = array(
                        "status" => "error",
                        "message" => "Der skete en fejl"
                    );
            }
        }
        return $response;
    }

    /**
     * Creates a new administrator
     * @param $username
     * @param $password
     * @return string[]
     */
    static function Create($username, $password):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        if (self::checkUsername($username)){
            $response = array(
                "status" => "error",
                "message" => "Brugernavnet findes, vælg venligst et andet"
            );
        }else {

            if ($conn) {
                $sql = $conn->prepare("INSERT INTO administrators (username, password) VALUES (?,?)");
                $sql->bind_param("ss", $username, $hashedPassword);
                if ($sql->execute())
                    $response = array(
                        "status" => "success",
                        "message" => "Bruger opdateret"
                    );
                else
                    $response = array(
                        "status" => "error",
                        "message" => "Der skete en fejl"
                    );
            }
        }
        return $response;
    }

    /**
     * Checks if the username exists
     * @param $username
     * @return bool
     */
    static function checkUsername($username):bool
    {
        $exists = false;
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT EXISTS(SELECT * FROM administrators WHERE username=?)AS 'exists'");
            $sql->bind_param("s", $username);
            $sql->execute();
            $result =$sql->get_result();
            if ($ex = $result->fetch_assoc()['exists']){
                if ($ex == true)
                    $exists = true;
                else
                    $exists = false;
            }
        }
        return $exists;
    }
}