<?php


class Omklubben
{
    /**
     * Gets all info about the club
     * @return string[]|null
     */
    static function Load():array|null
    {
        $response = array();
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM about WHERE id=1");
            if ($sql->execute()) {
                $result = $sql->get_result();
                $content = $result->fetch_assoc();
                $response =$content;
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Kunne ikke hente info om klubben"
                );
            }
        }
        return $response;
    }

    /**
     * Updates the text in the about page
     * @param string $content
     * @return string[]
     */
    static function Update(string $content):array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("UPDATE about SET content=? WHERE id=1");
            $sql->bind_param("s", $content);
            if ($sql->execute()) {
                $response = array(
                    "status" => "success",
                    "message" => "Info om klubben opdateret"
                );
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Kunne ikke opdatere info om klubben"
                );
            }
        }
        return $response;
    }

}