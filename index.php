<?php
include "templates/header.php";
include "BL/dbConnections/dbConnection.php";
global $conn;

include "adminpanel/frontpage/Frontpage.php";
$content = Frontpage::Load();

$pictures = Frontpage::LoadPictures();
$order   = array('\r\n', '\n', '\r');
$replace = '';
$content['content'] = str_replace($order, $replace, $content['content']);
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

<!--    <div id="animationVB" style="margin-top: 2%">-->
<!--        <img src="billeder/volleyballhand.png" style="height: 200px">-->
<!--        <img src="billeder/volleyball.png" class="animation" style="z-index: 5">-->
<!--        <img src="billeder/volleyballhand.png" style="float: right;  height: 200px; transform: scaleX(-1); z-index: -1">-->
<!--    </div>-->

    <?php echo stripslashes($content['content']); ?>
</div>


<?php include "templates/footer.php"; ?>
