<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Tilmelding.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'load'){

    $content = Tilmelding::Load();

    echo json_encode($content);
}

if ($action == 'update'){

    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $result = Tilmelding::Update($content);

    echo json_encode($result);
}