<?php
session_start();
include '../dbConnections/dbConnection.php';
global $conn;

function ExtendedAddslash(&$params)
{
    foreach ($params as &$var)
    {
        is_array($var) ? ExtendedAddslash($var) : $var=addslashes($var);
    }
}
ExtendedAddslash($_POST);

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


$stmt = $conn->prepare("SELECT * FROM administrators WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
if ($stmt->execute()){
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['volleyball_validation'] = true;
        $_SESSION['volleyball_username'] = $username;
        echo "true";
    } else {
        echo "false";
    }
}