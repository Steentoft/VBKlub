<?php
include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
    global $conn;

include "bestyrelse/Bestyrelse.php";
$members = Bestyrelse::Load();

?>

<table class="table table-striped" id="bestyrelseTable" class="display" width="100%">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Navn</th>
            <th scope="col">Titel</th>
            <th scope="col">Mobil</th>
            <th scope="col">Email</th>
            <th style="text-align: center" scope="col">Billede</th>
            <th style="text-align: center" scope="col">Rediger</th>
            <th style="text-align: center" scope="col">Slet</th>
        </tr>
        </thead>
        <tbody>
    <?php
    foreach ($members as $member)
    {
        ?>
        <tr>
            <td><?php echo $member['fullname'] ?></td>
            <td><?php echo $member['title'] ?></td>
            <td><?php echo $member['phonenumber'] ?></td>
            <td><?php echo $member['email'] ?></td>
            <td><img class="img-row-show" value="../billeder/bestyrelse/<?php echo $member['picture_path'] ?>" onclick="showPicture(this);" src="../billeder/image_icon.png" data-toggle="modal" data-target="#PictureModal"></td>
            <td><img class="img-row-show" value="<?php echo $member['id'] ?>" src="../billeder/edit_icon.png" onclick="editRow(this);" data-toggle="modal" data-target="#EditModal"></td>
            <td><img class="img-row-show" value="<?php echo $member['id'] ?>" src="../billeder/delete_icon.png" onclick="deleteConfirm(this)" data-toggle="modal" data-target="#DeleteModal"></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<button style="margin: 1%" class="btn btn-dark" onclick="//createRow();" data-toggle="modal" data-target="#CreateModal">Ny række</button>

<div class="modal fade" id="PictureModal" tabindex="-1" role="dialog" aria-labelledby="PictureModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
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

<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="CreateModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Oprettelse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                <form>
                    <div class="form-group">
                        <label for="name">Fuldtnavn</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="createName" placeholder="Fuldtnavn">
                    </div>
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="createTitle" placeholder="Titel">

                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Mobil</label>
                        <input type="tel" class="form-control mr-sm-2 mb-2" maxlength="8" id="createPhonenumber" placeholder="Mobil">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mr-sm-2 mb-2" id="createEmail" placeholder="Email">
                        <small id="createEmailHelp" class="form-text text-muted" style="display: none; color: red !important;">Ugyldig email.</small>

                    </div>
                    <div class="form-group">
                        <label for="customFile">Billede</label>
                        <div class="custom-file mr-sm-2 mb-2">
                            <input type="file" class="custom-file-input" id="createPicture">
                            <label class="custom-file-label" id="createPicture_path" for="customFile">Vælg fil</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger " data-dismiss="modal" id="createRow" onclick="createRow()">Gem</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rediger</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                <form>
                    <input value="" id="hiddenID" hidden>
                    <div class="form-group">
                        <label for="name">Fuldtnavn</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="name" placeholder="Fuldtnavn">
                    </div>
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="title" placeholder="Titel">

                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Mobil</label>
                        <input type="tel" class="form-control mr-sm-2 mb-2" maxlength="8" id="phonenumber" placeholder="Mobil">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mr-sm-2 mb-2" id="email" placeholder="Email">
                        <small id="emailHelp" class="form-text text-muted" style="display: none; color: red !important;">Ugyldig email.</small>
                    </div>
                    <div class="form-group">
                        <label for="customFile">Billede</label>
                        <div class="custom-file mr-sm-2 mb-2">
                            <input type="file" class="custom-file-input" id="picture">
                            <label class="custom-file-label" id="picture_path" for="picture">Vælg fil</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger " data-dismiss="modal" id="updateRow" onclick="updateRow()">Gem</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Slet række</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" value="" id="deleteConfirm" onclick="deleteRow(this);">Slet</button>
            </div>
        </div>
    </div>
</div>

</div>

<?php include "../templates/javaScriptLinks.html"?>
<script src="bestyrelse/bestyrelse.js"></script>
</body>
</html>