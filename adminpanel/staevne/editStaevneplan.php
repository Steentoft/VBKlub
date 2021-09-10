<?php

class editStaevneplan
{
    // Locations
    static function LoadLocations(){
        global $conn;
        if($conn){
            $sql = $sql = $conn->prepare("SELECT * FROM locations ORDER BY location ASC;");
            if($sql->execute()){
                $Result = $sql->get_result();
                if (mysqli_num_rows($Result) > 0) {
                    $Locations = [];
                    foreach ($Result as $Location) {
                        array_push($Locations, json_encode($Location));
                    }
                    return json_encode($Locations);
                }
            }
        }
    }

    static function CreateLocation($Location){
        global $conn;
        $RetrieveTable= $conn->prepare("SELECT * FROM locations");
        $result = $RetrieveTable->execute();
        $Locations = $RetrieveTable->get_result();
        foreach($Locations as $d){
            if($d['location'] == $Location){
                echo 0;
                exit();
            }
        }

        $AddLocation = $conn->prepare("INSERT INTO locations (`location`) VALUES (?)");
        $AddLocation->bind_param("s", $Location);
        $result2 = $AddLocation->execute();
        echo 1;
    }

    static function DeleteLocation($Array) {
        global $conn;
        foreach($Array as $Location){
            $sql = $conn->prepare("DELETE FROM locations WHERE id=?");
            $sql->bind_param("i", $Location);
            $sql->execute();
        }
    }

    // Conventions
    static function LoadConventions() {
        global $conn;
        $stmt = $conn->prepare("SELECT conventions.*, locations.location FROM conventions INNER JOIN locations ON conventions.location=locations.id ORDER BY conventions.name ASC");
        $row = array();
        if ($stmt->execute()){
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                $Conventions = [];
                foreach($result as $d){
                    array_push($Conventions, json_encode($d));
                }
                return json_encode($Conventions);
            } else {
                return "false";
            }
        }
    }

    static function CreateConvention($Name, $Date, $Start, $End, $Location) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM locations where locations.location = ?");
        $stmt->bind_param("s", $Location);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            foreach($result as $location)
                $Location = $location['id'];
        }
        $sql = $conn->prepare("INSERT INTO conventions (`name`, `date`, `start_time`, `end_time`, `location`) VALUES (?,?,?,?,?)");
        $sql->bind_param("sssss", $Name, $Date, $Start, $End, $Location);
        $sql->execute();
    }

    static function DeleteConvention($id) {
        global $conn;
        $sql = $conn->prepare("DELETE FROM conventions WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
    }

    static function UpdateConvention($Name, $Date, $Start, $End, $Location, $Id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM locations where locations.location = ?");
        $stmt->bind_param("s", $Location);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            foreach($result as $location)
                $Location = $location['id'];
        };
        echo $Location;
        $sql = $conn->prepare("UPDATE `conventions` SET `name`=?,`date`=?,`start_time`=?,`end_time`=?,`location`=? WHERE id = ?");
        $sql->bind_param("sssssi", $Name, $Date, $Start, $End, $Location, $Id);
        $sql->execute();
    }
}