<?php
include '../../../BL/dbConnections/dbConnection.php';
global $conn;
$Location = mysqli_real_escape_string($conn, $_POST['Location']);
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
