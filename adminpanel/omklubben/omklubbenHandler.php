<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Omklubben.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'load'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $content = Omklubben::Load();

    echo $content;
}

if ($action == 'update'){

    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $result = Omklubben::Update($content);

    echo $result;
}