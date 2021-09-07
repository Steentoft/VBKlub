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

    static function Update($id, $username, $password)
    {
        global $conn;

        if ($conn) {
            $sql = $conn->prepare("UPDATE administrators SET username=?, password=? WHERE id=?");
            $sql->bind_param("ssi", $username, $password, $id);
            if ($sql->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
    }

    static function Create($username, $password)
    {
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("INSERT INTO administrators (username, password) VALUES (?,?)");
            $sql->bind_param("ss", $username, $password);
            if ($sql->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
    }

}