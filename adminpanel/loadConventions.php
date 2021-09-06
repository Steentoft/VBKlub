<?php
include '../dbConnections/dbConnection.php';
global $conn;
$stmt = $conn->prepare("SELECT * FROM conventions");
$row = array();
if ($stmt->execute()){
    while($result = $stmt->get_result())
        $result[] = $row;
    if (mysqli_num_rows($result) > 0) {
        echo $result;
    } else {
        echo "false";
    }
}