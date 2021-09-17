<?php


class Frontpage
{
    /**
     * Gets everything from frontpage table
     * @return array|string|null
     */
    static function Load():array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM frontpage WHERE id=1");
            if ($sql->execute()){
                $result = $sql->get_result();
                if ($content = $result->fetch_assoc()){
                    $response = array(
                        "status" => "success",
                        "message" => $content['content']
                    );
                }else{
                    $sql2 = $conn->prepare("INSERT INTO frontpage(id, content) VALUES (1,'')");
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
                    "message" => "Der skete en fejl med databasen"
                );
            }
        }
        return $response;
    }

    /**
     * Updates frontpage table
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
            $stmt = $conn->prepare("UPDATE frontpage SET content=? WHERE id=1");
            $stmt->bind_param("s", $content);
            if ($stmt->execute() and $stmt->affected_rows == 1) {
                $response = array(
                    "status" => "success",
                    "message" => "Forsiden er opdateret"
                );
            } else {
                $sql2 = $conn->prepare("INSERT INTO frontpage(id, content) VALUES (1,?)");
                $sql2->bind_param("s", $content);
                if ($sql2->execute()) {
                    $response = array(
                        "status" => "success",
                        "message" => "Forsiden er opdateret"
                    );
                }else{
                    $response = array(
                        "status" => "error",
                        "message" => "Kunne ikke opdatere"
                    );
                }
            }
        }
        return $response;
    }

    /**
     * Gets images to be shown on the frontpage
     * @return string[]
     */
    static function LoadPictures():array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT pictures.*, categories.category FROM pictures INNER JOIN categories ON categories.id = pictures.category WHERE frontpageEnabled=1");
            if ($sql->execute()) {
                $result = $sql->get_result();
                if ($content = $result->fetch_all(MYSQLI_ASSOC)) {
                    $response = array(
                        "status" => "success",
                        "message" => $content
                    );
                }else{
                    $response = array(
                        "status" => "error",
                        "message" => "Kunne ikke finde nogle billeder"
                    );
                }
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Kunne ikke finde nogle billeder"
                );
            }
        }
        return $response;
    }

}