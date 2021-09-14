<?php
include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
    global $conn;

include "bestyrelse/Bestyrelse.php";
$members = Bestyrelse::Load();
?>

<div class="table-responsive">
    <table class="table table-striped" id="bestyrelseTable" class="display" width="100%">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Navn</th>
                <th scope="col">Titel</th>
                <th scope="col">Mobil</th>
                <th scope="col">Email</th>
                <th class="center_table_text" scope="col">Billede</th>
                <th class="center_table_text" scope="col">Rediger</th>
                <th class="center_table_text" scope="col">Slet</th>
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
</div>
<div class="btn-create">
<button class="btn btn-dark" data-toggle="modal" data-target="#CreateModal">Ny række</button>
</div>
<!-- Picture modal-->
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

<!-- Create modal-->
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
                    <p id="createModalAlert" class="modalAlert">Navn og titel skal udfyldes.</p>
                    <p id="createModalAlertNumber" class="modalAlert">Ugyldigt telefonnummer</p>
                    <div class="form-group">
                        <label for="createName">Fuldenavn</label>
                        <input type="text" class="form-control mr-sm-2 mb-2 bestyrelseInput" id="createName" placeholder="Fuldenavn">
                    </div>
                    <div class="form-group">
                        <label for="createTitle">Titel</label>
                        <input type="text"  class="form-control mr-sm-2 mb-2 bestyrelseInput" id="createTitle" placeholder="Titel">

                    </div>
                    <div class="form-group">
                        <label for="createPhonenumber">Mobil</label>
                        <input type="tel" pattern="[0-9]+"  class="form-control mr-sm-2 mb-2 bestyrelseInput" maxlength="8" id="createPhonenumber" placeholder="Mobil">
                    </div>
                    <div class="form-group">
                        <label for="createEmail">Email</label>
                        <input type="email"  class="form-control mr-sm-2 mb-2 bestyrelseInput" id="createEmail" placeholder="Email">
                        <small id="createEmailHelp" class="form-text text-muted" style="display: none; color: red !important;">Ugyldig email.</small>

                    </div>
                    <div class="form-group">
                        <label for="createPicture">Billede</label>
                        <div class="custom-file mr-sm-2 mb-2">
                            <input type="file" class="custom-file-input" id="createPicture" accept="image/*">
                            <label class="custom-file-label" id="createPicture_path" for="createPicture">Vælg fil</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger " id="createRow" onclick="createRow()">Gem</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit modal-->
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
                    <p id="editModalAlert" class="modalAlert">Navn og titel skal udfyldes.</p>
                    <p id="editModalAlertNumber" class="modalAlert">Ugyldigt telefonnummer</p>
                    <div class="form-group">
                        <label for="name">Fuldenavn</label>
                        <input type="text"  class="form-control mr-sm-2 mb-2 bestyrelseInput" id="name" placeholder="Fuldenavn">
                    </div>
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text"  class="form-control mr-sm-2 mb-2 bestyrelseInput" id="title" placeholder="Titel">

                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Mobil</label>
                        <input type="tel" pattern="[0-9]+"  class="form-control mr-sm-2 mb-2 bestyrelseInput" maxlength="8" id="phonenumber" placeholder="Mobil">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"  class="form-control mr-sm-2 mb-2 bestyrelseInput" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="customFile">Billede</label>
                        <div class="custom-file mr-sm-2 mb-2">
                            <input type="file" class="custom-file-input" id="picture" accept="image/*">
                            <label class="custom-file-label" id="picture_path" for="picture">Vælg fil</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger" id="updateRow" onclick="updateRow()">Gem</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete modal-->
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