<?php
include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
    global $conn;

include "bestyrelse/Bestyrelse.php";
$members = Bestyrelse::Load();

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

</style>

<table class="table table-striped">
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
                        <input type="tel" class="form-control mr-sm-2 mb-2" id="createPhonenumber" placeholder="Mobil">
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
                        <label for="name">Fuldtnavn</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="name" placeholder="Fuldtnavn">
                    </div>
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" class="form-control mr-sm-2 mb-2" id="title" placeholder="Titel">

                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Mobil</label>
                        <input type="tel" class="form-control mr-sm-2 mb-2" id="phonenumber" placeholder="Mobil">
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

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

    function createRow(){
        let name = $('#createName').val();
        let title = $('#createTitle').val();
        let number = $('#createPhonenumber').val();
        let email = $('#createEmail').val();
        let picture_path = $('#createPicture_path').text();

        var fd = new FormData();
        var files = $('#createPicture')[0].files[0];
        fd.append('action', 'create');
        fd.append('name',name);
        fd.append('title',title);
        fd.append('number',number);
        fd.append('email',email);
        fd.append('picture_path',picture_path);
        fd.append('fileUpload', files);

        $.ajax({
            url: 'bestyrelse/bestyrelseHandler.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                location.reload();
            },
        });
    }

    function editRow(ele){
        let id = ele.getAttribute('value');

        $.post("bestyrelse/bestyrelseHandler.php",
            {
                action: 'single',
                id: id
            },
            function(data){
                let infomation = JSON.parse(data);
                $('#name').val(infomation['fullname']);
                $('#title').val(infomation['title']);
                $('#phonenumber').val(infomation['phonenumber']);
                $('#email').val(infomation['email']);
                $('#picture_path').text(infomation['picture_path']);
                $('#hiddenID').attr('value', infomation['id'])
            });
    }

    function updateRow(){
        let id = $('#hiddenID').val();

        let name = $('#name').val();
        let title = $('#title').val();
        let number = $('#phonenumber').val();
        let email = $('#email').val();
        let picture_path = $('#picture_path').text();

        var fd = new FormData();
        var files = $('#picture')[0].files[0];
        fd.append('action', 'update');
        fd.append('id',id);
        fd.append('name',name);
        fd.append('title',title);
        fd.append('number',number);
        fd.append('email',email);
        fd.append('picture_path',picture_path);
        fd.append('fileUpload', files);

        $.ajax({
            url: 'bestyrelse/bestyrelseHandler.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                location.reload();
            },
        });
    }

    function deleteConfirm(ele){
        $('#deleteConfirm').val(ele.getAttribute('value'));
    }

    function deleteRow(ele){
        let id = ele.getAttribute('value');

        $.post("bestyrelse/bestyrelseHandler.php",
            {
                action: 'delete',
                id: id
            },
            function(data){
                location.reload();
            });
    }

    function showPicture(ele){
        let imgPath = ele.getAttribute('value');
        document.getElementById('modalPicture').setAttribute('src', imgPath);
    }

    $('#createEmail').change(function (){

        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,6})+$/;
        let result = regex.test($('#createEmail').val());
        if(!result){
            $('#createRow').prop('disabled', true);
            $('#createEmailHelp').css('display', 'block');
        } else {
            $('#createRow').prop('disabled', false);
            $('#createEmailHelp').css('display', 'none');

        }
    });

    $('#email').change(function (){

        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,6})+$/;
        let result = regex.test($('#email').val());
        if(!result){
            $('#updateRow').prop('disabled', true);
            $('#emailHelp').css('display', 'block');
        } else {
            $('#updateRow').prop('disabled', false);
            $('#emailHelp').css('display', 'none');

        }
    });

    $('input#createPicture').change(function(e){
        let fileName = e.target.files[0].name;
        document.getElementById('createPicture_path').innerHTML = fileName;
    });

    $('input#picture').change(function(e){
        let fileName = e.target.files[0].name;
        document.getElementById('picture_path').innerHTML = fileName;
    });
</script>
</body>
</html>