<?php
include "templates/header.php";
include "BL/dbConnections/dbConnection.php";
global $conn;

include "adminpanel/frontpage/Frontpage.php";
$response = Frontpage::Load();
$content = "";
if ($response['status'] == 'success')
    $content = $response['message'];
elseif($response['status'] == 'error')
    echo '<script>alert("'.$response["message"].'");</script>';

$pic = Frontpage::LoadPictures();
$pictures = array();
if ($pic['status'] == 'success')
    $pictures = $pic['message'];

$order   = array('\r\n', '\n', '\r');
$replace = '';
$content = str_replace($order, $replace, $content);
;?>

<div style="padding: 1%">
    <div id="pictureCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img <?php if($pictures!=null && count($pictures) > 0){ echo 'src="billeder/' .  $pictures[0]['category'] . '/' . $pictures[0]['path'] . '"'; }else echo 'src="billeder/default.png"'?> class="d-block justify-content-center">
            </div>
            <?php
            unset($pictures[0]);
            foreach ($pictures as $picture)
            {
            ?>
            <div class="carousel-item">
                <img src="billeder/<?php echo $picture['category'] ?>/<?php echo $picture['path'] ?>" class="d-block justify-content-center">
            </div>
                <?php
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#pictureCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#pictureCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <?php echo stripslashes($content); ?>
</div>


<?php include "templates/footer.php"; ?>
