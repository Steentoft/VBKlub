<?php
global $conn;
include "editStaevneplan.php";
include "../../BL/dbConnections/dbConnection.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$Name = mysqli_real_escape_string($conn, $_POST['Name']);
$Date = mysqli_real_escape_string($conn, $_POST['Date']);
$Start = mysqli_real_escape_string($conn, $_POST['Start']);
$End = mysqli_real_escape_string($conn, $_POST['End']);
$Location = mysqli_real_escape_string($conn, $_POST['Location']);

switch ($action) {
    case "CreateConvention":
        editStaevneplan::CreateConvention($Name, $Date, $Start, $End, $Location);
        break;
    case "DeleteConvention":
        editStaevneplan::DeleteConvention($id);
        break;
    case "UpdateConvention":
        editStaevneplan::UpdateConvention($Name, $Date, $Start, $End, $Location, $id);
        break;
    case "DeleteLocations":
        $Array = $_POST['Array'];
        editStaevneplan::DeleteLocation($Array);
        break;
    case "CreateLocation":
        editStaevneplan::CreateLocation($Location);
        break;
    default:
        echo "Error";
        break;
}