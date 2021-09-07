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

    $member = Bestyrelse::LoadSingle($id);

    echo $member;
}