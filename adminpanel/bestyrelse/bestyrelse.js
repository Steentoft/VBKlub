
$(document).ready(function () {
    $('#bestyrelseTable').DataTable( {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/da.json'
        }
    } );
});

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