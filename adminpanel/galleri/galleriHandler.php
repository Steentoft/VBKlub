<?php
include "../../BL/dbConnections/dbConnection.php";
global $conn;

include "Galleri.php";
$pic = new Galleri();

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'update'){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $fileUpload = $_FILES;
    $picture_path = mysqli_real_escape_string($conn, $_POST['fileName']);

    $result = $pic->Update($id, $title, $category, $date, $picture_path, $fileUpload);

    print_r($result);
}

if ($action == 'Create'){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $fileUpload = $_FILES;
    $picture_path = mysqli_real_escape_string($conn, $_POST['fileName']);

    $result = $pic->Upload($category, $title, $date);

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

if ($action == 'Select'){
    $date = "";
    $category = "";
    if (isset($_POST['date'])) {
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        if ($date == "undefined"){
            $date = "";
        }
    }
    if (isset($_POST['category'])) {
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        if ($category == "undefined"){
            $category = "";
        }
    }

    $result = "";
    if ($date =="" && $category!=""){
        $result = $pic->LoadSpecificCategory($category);
    }
    elseif ($date !="" && $category==""){
        $result = $pic->LoadSpecificYear($date);
    }
    elseif($date !="" && $category!=""){
        $result = $pic->LoadSpecific($date, $category);
    }
    if ($category == "Alle" && $date != ""){
        $result = $pic->LoadSpecificYear($date);
    }

    echo json_encode($result);
}

if ($action == 'SelectCategories'){
    $date = "";
    if (isset($_POST['date'])) {
        $date = mysqli_real_escape_string($conn, $_POST['date']);
    }


    $result = $pic->LoadCategories($date);

    echo json_encode($result);
}
