<?php
include "templates/header.php";
include "BL/dbConnections/dbConnection.php";
global $conn;

include "adminpanel/frontpage/Frontpage.php";
$content = Frontpage::Load();
$order   = array('\r\n', '\n', '\r');
$replace = '';
$content['content'] = str_replace($order, $replace, $content['content']);

;?>



<div style="padding: 1%">
    <?php echo stripslashes($content['content']); ?>
</div>


<?php include "templates/footer.php"; ?>
