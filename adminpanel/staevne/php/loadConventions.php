<?php
include '../../../BL/dbConnections/dbConnection.php';
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
        echo json_encode($Conventions);
    } else {
        echo "false";
    }
}