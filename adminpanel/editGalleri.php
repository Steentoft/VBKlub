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

<link rel="stylesheet" href="../css/editgalleri.css">
<div class="row">
    <div class="col">
        <button class="btn btn-dark" data-toggle="modal" data-target="#createModal">Ny række</button>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Titel</th>
            <th scope="col">Kategori</th>
            <th scope="col">Dato</th>
            <th class="center_table_text" scope="col">Billede</th>
            <th class="center_table_text" scope="col">Rediger</th>
            <th class="center_table_text" scope="col">Slet</th>
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
                <td><img class="img-row-show" value="../../billeder/<?php echo $picture['category']."/".$picture['path']; ?>" onclick="showPicture(this);"
                         src="../billeder/image_icon.png" data-toggle="modal" data-target="#imageModal"></td>

                <td><img class="img-row-show" value="<?php print($picture['id']);?>" src="../billeder/edit_icon.png"
                         data-toggle="modal" data-target="#editModal" onclick="showEdit(this);"></td>

                <td><img class="img-row-show" value="<?php print($picture['id']);?>" src="../billeder/delete_icon.png"
                         data-toggle="modal" data-target="#deleteModal" onclick="showDelete(this);"></td>
            </tr>

            <?php } ?>
        </tbody>
    </table>
</div>

<?php include_once "galleri/modals.html"; ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="galleri/gallery_js.js"></script>

</body>
</html>