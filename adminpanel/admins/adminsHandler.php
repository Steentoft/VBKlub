<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Admins.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'single'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $admin = Admins::LoadSingle($id);

    echo $admin;
}

if ($action == 'update'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $result = Admins::Update($id, $username, $password);

    echo $result;
}

if ($action == 'delete'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $result = Admins::Delete($id);

    echo $result;
}

if ($action == 'create'){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = Admins::Create($username, $password);

    echo $result;
}