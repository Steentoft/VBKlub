<?php include "templates/header.php";
include "BL/dbConnections/dbConnection.php";
global $conn;
include_once "adminpanel/galleri/Galleri.php";
$pic = new Galleri();

$pictures = $pic->Load();

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo("<script>history.replaceState({},'','$url');</script>");
?>


<select class="custom-select" id="dateSelect">
    <option selected value="">Årstal</option>

<?php
$od="";
foreach ($pictures as $picture){
    $dato = date("Y", strtotime($picture['date']));
    if ($od == $dato)
        continue; $od = $dato;
    $od = $dato;

    echo "<option value='$dato'>$dato</option>";

}
?>

</select>

<select class="custom-select d-none" id="categorySelect">
    <option selected value="">Kategori</option>

</select>

<div class="row content justify-content-center">
    <?php
    if (count($pictures) <1)
        echo "<img class='noImage' src='billeder/noImage.png'>"?>
    <div class="row img-row">
        <div id="leftCol" class="column img-column justify-content-center">
            </div>
        <div id="rightCol" class="column img-column justify-content-center">
        </div>
    </div>
</div>


<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="title"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                <img src="" id="modalPicture">
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<?php include "templates/footer.php"; ?>


<script src="js/gallery.js"></script>