<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Omklubben.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'update'){

    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $result = Omklubben::Update($content);

    echo json_encode($result);
}