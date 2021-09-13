<?php include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
global $conn;
include_once "galleri/Galleri.php";
$pic = new Galleri;
$pictures = $pic->Load();
global $allowedFileType;
if (isset($_POST['deleteImage']))
    $pic->Delete($_POST['deleteImage']);

?>

<div class="row">
    <div class="col">
        <button class="btn btn-dark" data-toggle="modal" data-target="#createModal">Ny række</button>
    </div>
</div>
<div class="table-responsive">
    <table id="editGallery" class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Titel</th>
            <th scope="col">Kategori</th>
            <th scope="col">Dato</th>
            <th class="center_table_text" scope="col">Forside</th>
            <th class="no-sort center_table_text" scope="col">Billede</th>
            <th class="no-sort center_table_text" scope="col">Rediger</th>
            <th class="no-sort center_table_text" scope="col">Slet</th>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pictures as $picture){
            ?>
            <tr>
                <td><?php echo $picture['title'] ?></td>
                <td><?php echo $picture['category'] ?></td>
                <td><?php echo $picture['date'] ?></td>
                <?php
                if ($picture['frontpageEnabled']==true){
                    echo "<td data-sort=0 ><img class='img-row-show' src='../billeder/check.png' value='true'";
                }
                else{
                    echo "<td data-sort=1 ><img class='img-row-show' src='../billeder/cross.png' value='false'";
                }
                ?>
                onclick="changeState(this);"></td>

                <td><img class="img-row-show" value="../../billeder/<?php echo $picture['category']."/".$picture['path']; ?>" onclick="showPicture(this);"
                         src="../billeder/image_icon.png" data-toggle="modal" data-target="#imageModal"></td>

                <td><img class="img-row-show" id="hiddenID" value="<?php print($picture['id']);?>" src="../billeder/edit_icon.png"
                         data-toggle="modal" data-target="#editModal" onclick="showEdit(this);"></td>

                <td><img class="img-row-show" value="<?php print($picture['id']);?>" src="../billeder/delete_icon.png"
                         data-toggle="modal" data-target="#deleteModal" onclick="showDelete(this);"></td>
            </tr>

            <?php } ?>
        </tbody>
    </table>
</div>

<?php include_once "galleri/modals.html"; ?>

</div>
<?php include "../templates/javaScriptLinks.html"?>
<script src="galleri/gallery_js.js"></script>

</body>
</html>