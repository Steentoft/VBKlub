
/**
 * Enables sorting of the table
 */
$(document).ready( function () {
    $('#table').DataTable( {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/da.json'
        },
        "columnDefs": [ {
            "targets"  : 'no-sort',
            "orderable": false,
            "order": []
        }]
    } );
} );

function createRow(){
    let username = $('#createUsername').val();
    let password = $('#createPassword').val();

    let fd = new FormData();
    fd.append('action', 'create');
    fd.append('username',username);
    fd.append('password',password);

    $.ajax({
        url: 'admins/adminsHandler.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            let info = JSON.parse(response);
            if (info['status'] === "error")
                alert(info['message']);
            location.reload();
        },
    });
}

function editRow(ele){
    let id = ele.getAttribute('value');

    $.post("admins/adminsHandler.php",
        {
            action: 'single',
            id: id
        },
        function(data){
            let infomation = JSON.parse(data);
            $('#username').val(infomation['username']);
            $('#username').attr('data-oldName',infomation['username']);
            $('#hiddenID').attr('value', infomation['id'])

        });
}

function updateRow(){
    let id = $('#hiddenID').val();
    let username = $('#username').val();
    let oldUsername = $('#username').attr('data-oldName');
    let password = $('#password').val();

    let fd = new FormData();
    fd.append('action', 'update');
    fd.append('id',id);
    fd.append('username',username);
    fd.append('oldUsername',oldUsername);
    fd.append('password',password);

    $.ajax({
        url: 'admins/adminsHandler.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            let info = JSON.parse(response);
            if (info['status'] === "error")
                alert(info['message']);
            location.reload();
        },
    });
}

function deleteConfirm(ele){
    $('#deleteConfirm').val(ele.getAttribute('value'));
}

function deleteRow(ele){
    let id = ele.getAttribute('value');

    $.post("admins/adminsHandler.php",
        {
            action: 'delete',
            id: id
        },
        function(data){
            location.reload();
        });
}

