<?php
include '../../BL/dbConnections/dbConnection.php';
global $conn;
$Name = mysqli_real_escape_string($conn, $_POST['Name']);
$Date = mysqli_real_escape_string($conn, $_POST['Date']);
$Start = mysqli_real_escape_string($conn, $_POST['Start']);
$End = mysqli_real_escape_string($conn, $_POST['End']);
$Location = mysqli_real_escape_string($conn, $_POST['Location']);
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
if ($sql->execute()){
    return 'success';
}else{
    return 'error';
}