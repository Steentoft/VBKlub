<?php


class Tilmelding
{
    /**
     * Gets everything from registration table
     * @return array|string|null
     */
    static function Load(){
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM registration WHERE id=1");
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
     * Updates registration table
     * @param string $content
     * @return string|void
     */
    static function Update(string $content){
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("UPDATE registration SET content=? WHERE id=1");
            $sql->bind_param("s", $content);
            if ($sql->execute()) {

            } else {
                return 'error';
            }
        }
    }
}