<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Bestyrelse.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'single'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $member = Bestyrelse::LoadSingle($id);

    echo $member;
}

if ($action == 'update'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $picture_path = mysqli_real_escape_string($conn, $_POST['picture_path']);

    $result = Bestyrelse::Update($id, $name, $title, $picture_path, $number, $email);

    echo json_encode($result);
}

if ($action == 'delete'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $result = Bestyrelse::Delete($id);

    echo json_encode($result);
}

if ($action == 'create'){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $result = Bestyrelse::Create($name, $title, $number, $email);

    echo json_encode($result);
}