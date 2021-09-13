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


$stmt = $conn->prepare("SELECT * FROM administrators WHERE username=?");
$stmt->bind_param("s", $username);
if ($stmt->execute()){
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
        $hashedPassword = $result->fetch_assoc()['password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['volleyball_validation'] = true;
            header('Location: ../../adminpanel');
        }
        else{
            echo "password failed: ".password_verify($password, $hashedPassword);
        }
    } else {
        echo "false";
    }
}