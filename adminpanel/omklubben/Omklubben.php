<?php


class Omklubben
{
    static function Load(){
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM about WHERE id=1");
            if ($sql->execute()){
                $result = $sql->get_result();
                $content = $result->fetch_assoc();
            } else {
                return 'error';
            }
        }
        return $content;
    }

    static function Update($content){
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("UPDATE about SET content=? WHERE id=1");
            $sql->bind_param("s", $content);
            if ($sql->execute()) {

            } else {
                return 'error';
            }
        }
    }

}