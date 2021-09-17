<?php


class Omklubben
{
    /**
     * Gets all info about the club
     * @return string[]
     */
    static function Load():array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM about WHERE id=1");
            if ($sql->execute()) {
                $result = $sql->get_result();
                if ($content = $result->fetch_assoc()){
                    $response = array(
                        "status" => "success",
                        "message" => $content['content']
                    );
                }else{
                    $sql2 = $conn->prepare("INSERT INTO about(id, content) VALUES (1,'')");
                    if ($sql2->execute()) {
                        $response = array(
                            "status" => "alert",
                            "message" => "Oprettede en ny række"
                        );
                    }else{
                        $response = array(
                            "status" => "error",
                            "message" => "Kunne ikke finde noget data i databasen"
                        );
                    }
                }
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
            if ($sql->execute() and $sql->affected_rows == 1) {
                $response = array(
                    "status" => "success",
                    "message" => "Opdaterede om klubben"
                );
            } else {
                $sql2 = $conn->prepare("INSERT INTO about(id, content) VALUES (1,?)");
                $sql2->bind_param("s", $content);
                if ($sql2->execute()) {
                    $response = array(
                        "status" => "success",
                        "message" => "Opdaterede om klubben"
                    );
                }else {
                    $response = array(
                        "status" => "error",
                        "message" => "Kunne ikke opdatere"
                    );
                }
            }
        }
        return $response;
    }

}