<?php
session_start();
include '../dbConnections/dbConnection.php';
global $conn;

$action = mysqli_real_escape_string($conn, $_POST['action']);

if ($action == 'verify'){
    echo json_encode(verify::verifyLogin());
}
class verify
{
    static function ExtendedAddslash(&$params)
    {
        foreach ($params as &$var) {
            is_array($var) ? self::ExtendedAddslash($var) : $var = addslashes($var);
        }
    }

    static function verifyLogin(): array
    {
        global $conn;
        self::ExtendedAddslash($_POST);

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $response = array(
            "status" => "error",
            "message" => "Noget gik galt"
        );

        $stmt = $conn->prepare("SELECT * FROM administrators WHERE username=?");
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                $hashedPassword = $result->fetch_assoc()['password'];
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['volleyball_validation'] = true;
                    $response = array(
                        "status" => "success",
                        "message" => "Du er logget ind"
                    );
                } else {
                    $response = array(
                        "status" => "error",
                        "message" => "Forkert brugernavn eller kodeord"
                    );
                }
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Forkert brugernavn eller kodeord"
                );
            }
        }
        return $response;
    }
}