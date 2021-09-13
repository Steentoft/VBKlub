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
if (count($pictures) > 0){
    echo 'test';
}
;?>

<style>
    .d-block{
        height: 50vh !important;
        margin: auto;
    }

    .carousel{
        background: black !important;
    }

    .animation {
        height: 125px;
        margin-bottom: 5%;
        position: relative;
        animation: example 2s infinite;
    }

    @keyframes example {
        from {
            transform:rotate(0deg);
        }
        to {
            transform:rotate(360deg);
        }
    }



    @media screen and (max-width: 768px) {

        #animationVB{
            display: none;
        }
    }

    @media (min-width: 768px) {

        .animation {
            animation: example 1.5s infinite;
        }

        @keyframes example {
            0%,
            100% {
                left: -14%;
            }
            50% {
                left: 44%;
                transform:rotate(180deg);
            }
        }
    }

    @media (min-width: 992px) {

        .animation {
            animation: example 2s infinite;
        }

        @keyframes example {
            0%,
            100% {
                left: -10%;
            }
            50% {
                left: 57.5%;
                transform:rotate(360deg);
            }
        }
    }

    @media (min-width: 1200px) {
        .animation {
            animation: example 2.5s infinite;
        }

        @keyframes example {
            0%,
            100% {
                left: -10%;
            }
            50% {
                left: 65%;
                transform:rotate(720deg);
            }
        }
    }

</style>

<div style="padding: 1%">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img <?php if(count($pictures) > 0){ echo 'src="billeder/' .  $pictures[0]['category'] . '/' . $pictures[0]['path'] . '"'; }else echo 'src="billeder/default.png"'?> class="d-block justify-content-center">
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
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div id="animationVB" style="margin-top: 2%">
        <img src="billeder/volleyballhand.png" style="height: 200px">
        <img src="billeder/volleyball.png" class="animation" style="z-index: 5">
        <img src="billeder/volleyballhand.png" style="float: right;  height: 200px; transform: scaleX(-1); z-index: -1">
    </div>

    <?php echo stripslashes($content['content']); ?>
</div>


<?php include "templates/footer.php"; ?>
