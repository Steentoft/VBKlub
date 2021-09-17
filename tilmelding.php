<?php
include "templates/header.php";
include "BL/dbConnections/dbConnection.php";
global $conn;

include "adminpanel/tilmelding/Tilmelding.php";
$response = Tilmelding::Load();
$content = "";
if ($response['status'] == 'success')
    $content = $response['message'];
elseif($response['status'] == 'error')
    echo '<script>alert("'.$response["message"].'");</script>';

$order   = array('\r\n', '\n', '\r');
$replace = '';
$content = str_replace($order, $replace, $content);

?>

<div id="tilmelding" style="padding: 1%">
    <?php echo stripslashes($content); ?>
</div>

<?php include "templates/footer.php"; ?>