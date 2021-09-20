<?php
include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
global $conn;

include "links/Links.php";
$links = Links::Load();

?>

<div class="table-responsive">
    <table class="table table-striped" id="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Titel</th>
            <th scope="col">Link</th>
            <th class="no-sort center_table_text" scope="col">Rediger</th>
            <th class="no-sort center_table_text" scope="col">Slet</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($links as $link)
        {
            ?>
            <tr>
                <td><?php echo $link['title'] ?></td>
                <td><?php echo $link['link_path'] ?></td>
                <td><img class="img-row-show" value="<?php echo $link['id'] ?>" src="../billeder/edit_icon.png"
                         onclick="editRow(this);" data-toggle="modal" data-target="#EditModal"></td>
                <td><img class="img-row-show" value="<?php echo $link['id'] ?>" src="../billeder/delete_icon.png"
                         onclick="deleteConfirm(this)" data-toggle="modal" data-target="#DeleteModal"></td>
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

<!-- Create Modal-->
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
                <form autocomplete="off">
                    <div class="form-group">
                        <label for="createTitle">Titel</label>
                        <input autocomplete="off" type="text" class="form-control mr-sm-2 mb-2" id="createTitle" placeholder="Titel">
                    </div>
                    <div class="form-group">
                        <label for="createLink_path">Link</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="createLink_path" placeholder="Link">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger" onclick="createRow()">Gem</button>
            </div>
        </div>
    </div>
</div>

<!--Edit Modal-->
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
                        <label for="name">Titel</label>
                        <input data-oldName="" type="text" class="form-control mr-sm-2 mb-2" id="title" placeholder="Titel">
                    </div>
                    <div class="form-group">
                        <label for="title">Link</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="link_path" placeholder="Link">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fortryd</button>
                <button type="button" class="btn btn-danger" onclick="updateRow()">Gem</button>
            </div>
        </div>
    </div>
</div>

<!--Delete Modal-->
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
<script src="links/links.js"></script>
</body>
</html>