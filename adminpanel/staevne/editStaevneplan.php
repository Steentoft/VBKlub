<?php

class editStaevneplan
{
    /**
     * Gets all locations
     * @return false|string
     */
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
                }else{
                    return "false";
                }
            }
        }
        return "false";
    }

    /**
     * Creates a new location
     * @param string $Location
     */
    static function CreateLocation(string $Location){
        global $conn;
        $RetrieveTable= $conn->prepare("SELECT * FROM locations");
        $RetrieveTable->execute();
        $Locations = $RetrieveTable->get_result();
        foreach($Locations as $d){
            if($d['location'] == $Location){
                echo 0;
                exit();
            }
        }

        $AddLocation = $conn->prepare("INSERT INTO locations (`location`) VALUES (?)");
        $AddLocation->bind_param("s", $Location);
        $AddLocation->execute();
        echo 1;
    }

    /**
     * Deletes a location
     * @param string $Array
     */
    static function DeleteLocation(string $Array) {
        global $conn;
        foreach($Array as $Location){
            $sql = $conn->prepare("DELETE FROM locations WHERE id=?");
            $sql->bind_param("i", $Location);
            $sql->execute();
        }
    }

    /**
     * Gets all conventions
     * @return false|string
     */
    static function LoadConventions() {
        global $conn;
        $stmt = $conn->prepare("SELECT conventions.*, locations.location FROM conventions INNER JOIN locations ON conventions.location=locations.id ORDER BY conventions.name ASC");
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
        return false;
    }

    /**
     * Creates a new convention
     * @param string $Name
     * @param string $Date
     * @param string $Start
     * @param string $End
     * @param string $Location
     */
    static function CreateConvention(string $Name, string $Date, string $Start, string $End, string $Location) {
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

    /**
     * Deletes a convention
     * @param int $id
     */
    static function DeleteConvention(int $id) {
        global $conn;
        $sql = $conn->prepare("DELETE FROM conventions WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
    }

    /**
     * Updates convention
     * @param string $Name
     * @param string $Date
     * @param string $Start
     * @param string $End
     * @param string $Location
     * @param int $id
     */
    static function UpdateConvention(string $Name, string $Date, string $Start, string $End, string $Location, int $id){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM locations where locations.location = ?");
        $stmt->bind_param("s", $Location);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            foreach($result as $location)
                $Location = $location['id'];
        }
        echo $Location;
        $sql = $conn->prepare("UPDATE `conventions` SET `name`=?,`date`=?,`start_time`=?,`end_time`=?,`location`=? WHERE id = ?");
        $sql->bind_param("sssssi", $Name, $Date, $Start, $End, $Location, $id);
        $sql->execute();
    }
}