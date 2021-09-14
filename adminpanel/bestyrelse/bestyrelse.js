
$(document).ready(function () {
    $('#bestyrelseTable').DataTable( {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/da.json'
        },
        "columnDefs": [
            {
                "orderable": false,
                "order": [],
                "targets": [-1, -2, -3]
            }
        ],
    } );
});

function createRow(){
    let name, title, number, email, picture_path, validPhone;
    name = $('#createName');
    title = $('#createTitle');
    number = $('#createPhonenumber');
    email = $('#createEmail').val();
    picture_path = $('#createPicture_path').text();
    validPhone = number.is(':valid');
    number = number.val();

    title.attr('required',"");
    title = title.val();

    name.attr('required',"");
    name = name.val();

    if (!validPhone){
        $('#createModalAlert').css('display', 'none');
        $('#createModalAlertNumber').css('display', 'block');
        return null;
    }

    if (name === "" || title === ""){
        $('#createModalAlert').css('display', 'block');
        $('#createModalAlertNumber').css('display', 'none');
        return null;
    }

    $('#CreateModal').modal('hide');
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
            let info = JSON.parse(response);
            if (info['status'] === "error")
                alert(info['message']);
            if (info['status'] === "success")
                location.reload();
        },
    });
}

function updateRow(){
    let id, name, title, number, email, picture_path, validPhone;
    id = $('#hiddenID').val();

    name = $('#name');
    title = $('#title');
    number = $('#phonenumber');
    email = $('#email').val();
    picture_path = $('#picture_path').text();
    validPhone = number.is(':valid');
    number = number.val();

    title.attr('required',"");
    title = title.val();

    name.attr('required',"");
    name = name.val();

    if (!validPhone){
        $('#editModalAlert').css('display', 'none');
        $('#editModalAlertNumber').css('display', 'block');
        return null;
    }

    if (name === "" || title === ""){
        $('#editModalAlert').css('display', 'block');
        $('#editModalAlertNumber').css('display', 'none');
        return null;
    }

    $('#EditModal').modal('hide');
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
            let info = JSON.parse(response);
            if (info['status'] === "error")
                alert(info['message']);
            if (info['status'] === "success")
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
        function(response){
            let info = JSON.parse(response);
            if (info['status'] === "error")
                alert(info['message']);
            if (info['status'] === "success")
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
