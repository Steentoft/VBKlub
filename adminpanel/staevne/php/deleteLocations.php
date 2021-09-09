<?php
include '../../../BL/dbConnections/dbConnection.php';
global $conn;
$Array = $_POST['Array'];
foreach($Array as $Location){
    $sql = $conn->prepare("DELETE FROM locations WHERE id=?");
    $sql->bind_param("i", $Location);
    $result = $sql->execute();
}