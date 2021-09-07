<?php

class Bestyrelse
{
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

    static function LoadSingle($id)
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

    static function Delete($id)
    {
        $member = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("DELETE FROM members WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }


        return json_encode($member);
    }

    static function Update($id, $name, $title, $picture_path, $phonenumber, $email)
    {
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("UPDATE members SET fullname=?, title=?, picture_path=?, phonenumber=?, email=? WHERE id=?");
            $sql->bind_param("sssisi", $name, $title, $picture_path, $phonenumber, $email, $id);
            if ($sql->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
    }

}