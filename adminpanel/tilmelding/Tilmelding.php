<?php

class Tilmelding
{
    /**
     * Gets everything from registration table
     * @return string[]
     */
    static function Load(): array
    {
        $order   = array('\r\n', '\n', '\r' );
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("SELECT * FROM registration WHERE id=1");
            if ($sql->execute()){
                $result = $sql->get_result();
                if ($content = $result->fetch_assoc()) {
                    $content = $content['content'];
                    $content = str_replace($order, "", $content);
                    $content = stripslashes($content);
                    $response = array(
                        "status" => "success",
                        "message" => $content
                    );
                }else{
                    $sql2 = $conn->prepare("INSERT INTO registration(id, content) VALUES (1,'')");
                    if (!$sql2->execute()) {
                        $response = array(
                            "status" => "error",
                            "message" => "Kunne ikke finde noget data i databasen"
                        );
                    }else
                        $response = array(
                            "status" => "success",
                            "message" => "Oprettede en ny række"
                        );
                }
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Kunne ikke få forbindelse til databasen"
                );
            }
        }
        return $response;
    }

    /**
     * Updates registration table
     * @param string $content
     * @return string[]
     */
    static function Update(string $content): array
    {
        $response = array(
            "status" => "error",
            "message" => "Ukendt fejl"
        );
        global $conn;
        if ($conn) {
            $sql = $conn->prepare("UPDATE registration SET content=? WHERE id=1");
            $sql->bind_param("s", $content);
            if ($sql->execute() and $sql->affected_rows == 1) {
                $response = array(
                    "status" => "success",
                    "message" => "Tilmelding opdateret"
                );
            } else {
                $sql2 = $conn->prepare("INSERT INTO registration(id, content) VALUES (1,?)");
                $sql2->bind_param("s", $content);
                if ($sql2->execute()) {
                    $response = array(
                        "status" => "success",
                        "message" => "Tilmelding opdateret"
                    );
                }else {
                    $response = array(
                        "status" => "error",
                        "message" => "Kunne ikke oprette en ny tilmelding"
                    );
                }
            }
        } else{
            $response = array(
                "status" => "error",
                "message" => "Kunne ikke forbinde til databasen"
            );
        }
        return $response;
    }
}