<?php
    include "templates/header.php";
    include "BL/dbConnections/dbConnection.php";
    global $conn;

    include "adminpanel/omklubben/Omklubben.php";
    $response = Omklubben::Load();
    $content = "";
    if ($response['status'] == 'success')
        $content = $response['message'];
    elseif($response['status'] == 'error')
        echo '<script>alert("'.$response["message"].'");</script>';
    $order   = array('\r\n', '\n', '\r');
    $replace = '';
    $content['content'] = str_replace($order, $replace, $content['content']);

    ;?>



<div style="padding: 1%">
    <?php echo stripslashes($content['content']); ?>
</div>

<?php include "templates/footer.php"; ?>