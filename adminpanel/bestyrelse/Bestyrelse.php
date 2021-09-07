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
        global $conn;

        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM members WHERE id=?");
            $sql->bind_param("i", $id);
            if ($sql->execute()){
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) {
                    unlink('../../billeder/bestyrelse/' . $row['picture_path']);
                }
            }else{
                return 'error';
            }
        }

        if ($conn) {
            $sql2 = $conn->prepare("DELETE FROM members WHERE id=?");
            $sql2->bind_param("i", $id);
            if ($sql2->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
    }

    static function Update($id, $name, $title, $picture_path, $phoneNumber, $email)
    {
        global $conn;

        if ($_FILES["fileUpload"]["name"] != null) {
            if ($conn) {
                $sql = $conn->prepare("SELECT * FROM members WHERE id=?");
                $sql->bind_param("i", $id);
                if ($sql->execute()) {
                    $result = $sql->get_result();
                    while ($row = $result->fetch_assoc()) {
                        unlink('../../billeder/bestyrelse/' . $row['picture_path']);
                    }
                } else {
                    return 'error';
                }
            }

            $temp = explode(".", $_FILES["fileUpload"]["name"]);
            $picture_path = round(microtime(true)) . '.' . end($temp);

            $location = "../../billeder/bestyrelse/" . $picture_path;
            $uploadOk = 1;

            if ($uploadOk == 0) {
                echo 0;
            } else {
                if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $location)) {
                    echo $location;
                } else {
                    echo 0;
                }
            }
        }


        if ($conn) {
            $sql = $conn->prepare("UPDATE members SET fullname=?, title=?, picture_path=?, phonenumber=?, email=? WHERE id=?");
            $sql->bind_param("sssisi", $name, $title, $picture_path, $phoneNumber, $email, $id);
            if ($sql->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
    }

    static function Create($name, $title, $picture_path, $phoneNumber, $email)
    {
        global $conn;

        $temp = explode(".", $_FILES["fileUpload"]["name"]);
        $filename = round(microtime(true)) . '.' . end($temp);

        $location = "../../billeder/bestyrelse/".$filename;
        $uploadOk = 1;

        if($uploadOk == 0){
            echo 0;
        }else{
            if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $location)){
                echo $location;
            }else{
                echo 0;
            }
        }

        if ($conn) {
            $sql = $conn->prepare("INSERT INTO members (fullname, title, picture_path, phonenumber, email) VALUES (?,?,?,?,?)");
            $sql->bind_param("sssis", $name, $title, $filename, $phoneNumber, $email);
            if ($sql->execute()){
                return 'success';
            }else{
                return 'error';
            }
        }
    }

}