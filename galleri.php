<?php include "templates/header.php";
include "BL/dbConnections/dbConnection.php";
global $conn;
include_once "adminpanel/galleri/Galleri.php";
$pic = new Galleri();

$pictures = $pic->Load();
?>


<select class="custom-select" id="dateSelect">
    <option selected value="">Choose...</option>

<?php
$od="";
$dates = array();
foreach ($pictures as $picture){
    $dato = date("Y", strtotime($picture['date']));
    if ($od == $dato)
        continue; $od = $dato;
    $od = $dato;
    $dates[] = $dato;

//    echo "<a class='dropdown-item' href='?date=$dato'>$dato</a>";
    echo "<option value='$dato'>$dato</option>";

}
    echo $_GET['category'];
?>

</select>

        <select class="custom-select" id="categorySelect">
            <option selected value="">Choose...</option>
<?php
$pictures = $pic->LoadCategories();
$oc="";
$categories = array();
foreach ($pictures as $picture){
    $category = $picture['category'];
    if ($oc == $category)
        continue; $oc = $category;
    $oc = $category;
    $categories[] = $category;

//    echo "<a class='dropdown-item' href='?category=$category'>$category</a>";
    echo "<option value='$category'>$category</option>";


}

?>
        </select>

<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
<div class="row content">
    <div class="row img-row">
        <div id="leftCol" class="column img-column justify-content-center">

            <?php /*
            foreach ($dates as $date) {
                if (parse_url($actual_link, PHP_URL_QUERY) == $date) {
                    // PLACE SHOW IMAGE
                    $images = $pic->LoadSpecificYear($date);
                    $len = count($images);

                    $firsthalf = array_slice($images, 0, $len / 2);
                    $secondhalf = array_slice($images, $len / 2);

                    foreach ($firsthalf as $image) {
                        echo '<img value="'.$image['id'].'" class="gallery-picture" src="billeder/'.$image['category'].'/'.$image['path'].'" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">';
                    }*/
            ?>
        </div>
        <div id="rightCol" class="column img-column justify-content-center">

            <?php /*
                    foreach ($secondhalf as $image) {
                        echo '<img value="'.$image['id'].'" class="gallery-picture" src="billeder/'.$image['category'].'/'.$image['path'].'" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">';
                    }
                }
            }*/

        ?>

        <?php /*

        foreach ($categories as $category) {
        if (parse_url($actual_link, PHP_URL_QUERY) == $category) {
        // PLACE SHOW IMAGE
        $images = $pic->LoadSpecificCategory($category); // Return nothing
        $len = count($images);
        var_dump($images);

        $firsthalf = array_slice($images, 0, $len / 2);
        $secondhalf = array_slice($images, $len / 2);

        foreach ($firsthalf as $image) {
            echo '<img value="'.$image['id'].'" class="gallery-picture" src="billeder/'.$image['category'].'/'.$image['path'].'" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">';
        }*/
        ?>
        </div>
    </div>
</div>


<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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


<script src="ja/gallery.js"></script>