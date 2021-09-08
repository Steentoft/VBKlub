<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Tilmelding.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'load'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $content = Tilmelding::Load();

    echo $content;
}

if ($action == 'update'){

    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $result = Tilmelding::Update($content);

    echo $result;
}