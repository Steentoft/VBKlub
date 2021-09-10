<?php
global $conn;
include "editStaevneplan.php";
include "../../BL/dbConnections/dbConnection.php";

$action = mysqli_real_escape_string($conn, $_POST['action']);
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
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        editStaevneplan::DeleteConvention($id);
        break;
    case "UpdateConvention":
        $Id = mysqli_real_escape_string($conn, $_POST['Id']);
        editStaevneplan::UpdateConvention($Name, $Date, $Start, $End, $Location, $Id);
        break;
    case "DeleteLocations":
        $Array = $_POST['Array'];
        editStaevneplan::DeleteLocation($Array);
        break;
    case "CreateLocation":
        $Location = mysqli_real_escape_string($conn, $_POST['Location']);
        editStaevneplan::CreateLocation($Location);
        break;
    default:
        echo "Error";
        break;
}