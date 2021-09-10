<?php
include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
global $conn;

include "admins/Admins.php";
$members = Admins::Load();

?>

<style>
    .img-row-show{
        margin: auto;
        display: flex;
        cursor: pointer;
    }
    .custom-file-label{
        justify-content: start !important;
        align-items: start !important;
    }

    .password-hidden{
        filter:blur(5px);
    }

</style>

<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Brugernavn</th>
        <th scope="col">Kodeord</th>
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
            <td><?php echo $member['username'] ?></td>
            <td class="password-hidden"><?php echo $member['password'] ?></td>
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
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
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
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Oprettelse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                <form autocomplete="off">
                    <div class="form-group">
                        <label for="name">Brugernavn</label>
                        <input autocomplete="off" type="text" class="form-control mr-sm-2 mb-2" id="createUsername" placeholder="Brugernavn">
                    </div>
                    <div class="form-group">
                        <label for="title">Kodeord</label>
                        <input autocomplete="new-password" type="password" class="form-control mr-sm-2 mb-2" id="createPassword" placeholder="Kodeord">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger " data-dismiss="modal" onclick="createRow()">Gem</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
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
                        <label for="name">Brugernavn</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="username" placeholder="Brugernavn">
                    </div>
                    <div class="form-group">
                        <label for="title">Kodeord</label>
                        <input type="text" class="form-control mr-sm-2 mb-2 password-hidden" id="password" placeholder="Kodeord">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger " data-dismiss="modal" onclick="updateRow()">Gem</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
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
<script src="admins/admin.js"></script>
</body>
</html>