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
     * @return string|void
     */
    static function Update(string $content)
    {
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("UPDATE about SET content=? WHERE id=1");
            $sql->bind_param("s", $content);
            if ($sql->execute() and $sql->affected_rows == 1) {
                return 'Success';
            } else {
                $sql2 = $conn->prepare("INSERT INTO about(id, content) VALUES (1,?)");
                $sql2->bind_param("s", $content);
                if ($sql2->execute()) {
                    return "success";
                }
            }
        } else{
            return 'error';
        }
    }

}