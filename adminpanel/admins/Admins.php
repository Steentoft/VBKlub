<?php

class Admins
{
    /**
     * Gets all admins from database
     * @return array
     */
    static function Load():array
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

    /**
     * Gets single admin
     * @param $id
     * @return array
     */
    static function LoadSingle($id):array
    {
        $admin = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM administrators WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                $result = $sql->get_result();
                $admin = $result->fetch_assoc();
            }
        }
        return $admin;
    }

    /**
     * Deletes given admin
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
            $sql = $conn->prepare("DELETE FROM administrators WHERE id=?");
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
     * Updates selected admin, returns response
     * @param $id
     * @param $username
     * @param $password
     * @return string[]
     */
    static function Update($id, $username,$oldUsername, $password):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;

        if (!self::passwordStrength($password)){
            return array(
                "status" => "error",
                "message" => "Kodeord skal minimum være 8 karakterer lang og skal indeholde minimum et lille bogstav, et stort bogstav, et tal og et specialtegn",
            );
        }

        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

        if ($oldUsername != $username && self::checkUsername($username)){
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
                        "message" => "Der skete en fejl med databasen"
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
        if (!self::passwordStrength($password)){
            return array(
                "status" => "error",
                "message" => "Kodeord skal minimum være 8 karakterer lang og skal indeholde minimum et lille bogstav, et stort bogstav, et tal og et specialtegn",
            );
        }


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
                        "message" => "Der skete en fejl med databasen"
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

    /**
     * Checks if the password is strong enough
     * @param $password
     * @return bool
     */
    static function passwordStrength($password):bool
    {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return false;
        }else{
            return true;
        }
    }
}