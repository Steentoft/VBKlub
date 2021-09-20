<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Links.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'single'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $admin = Links::LoadSingle($id);

    echo json_encode($admin);
}

if ($action == 'update'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $path = mysqli_real_escape_string($conn, $_POST['link_path']);


    $result = Links::Update($id, $title, $path);

    echo json_encode($result);
}

if ($action == 'delete'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $result = Links::Delete($id);

    echo $result;
}

if ($action == 'create'){

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $path = mysqli_real_escape_string($conn, $_POST['link_path']);

    $result = Links::Create($title, $path);

    echo json_encode($result);
}