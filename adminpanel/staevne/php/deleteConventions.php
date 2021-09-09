<?php
include '../../../BL/dbConnections/dbConnection.php';
global $conn;
$id= mysqli_real_escape_string($conn, $_POST['id']);
$sql = $conn->prepare("DELETE FROM conventions WHERE id = ?");
$sql->bind_param("i", $id);
$result = $sql->execute();