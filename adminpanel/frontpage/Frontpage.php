<?php


class Frontpage
{
    /**
     * Gets everything from frontpage table
     * @return array|string|null
     */
    static function Load(){
        $content = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM frontpage WHERE id=1");
            if ($sql->execute()){
                $result = $sql->get_result();
                $content = $result->fetch_assoc();
            } else {
                return 'error';
            }
        }
        return $content;
    }

    /**
     * Updates frontpage table
     * @param string $content
     * @return string|void
     */
    static function Update(string $content){
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("UPDATE frontpage SET content=? WHERE id=1");
            $sql->bind_param("s", $content);
            if ($sql->execute()) {

            } else {
                return 'error';
            }
        }
    }

    /**
     * Gets images to be shown on the frontpage
     * @return mixed|string
     */
    static function LoadPictures(){
        $content = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON categories.id = pictures.category WHERE frontpageEnabled=1");
            if ($sql->execute()){
                $result = $sql->get_result();
                $content=$result->fetch_all(MYSQLI_ASSOC);
            } else {
                return 'error';
            }
        }
        return $content;
    }

}