<?php
include '../../BL/dbConnections/dbConnection.php';
global $conn;
$sql = $conn->prepare("SELECT * FROM locations ORDER BY location ASC;");
$result = $sql->execute();
$Locations = $sql->get_result();
echo json_encode(mysqli_fetch_all($Locations,  MYSQLI_ASSOC));