<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Galleri.php";
$pic = new Galleri();
if (!isset($_POST['action']))
    print_r($_FILES);
$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'update'){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $fileUpload = $_FILES;
    $picture_path = mysqli_real_escape_string($conn, $_POST['fileName']);

//$result = $_POST + $_FILES;
    $result = $pic->Update($id, $title, $category, $date, $picture_path, $fileUpload);

    print_r($result);
}

if ($action == 'Delete'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $result = $pic->Delete($id);

    echo $result;
}

if ($action == 'single'){

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $result = $pic->LoadSingle($id);

    echo $result;
}