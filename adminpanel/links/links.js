
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
    let title = $('#createTitle').val();
    let link_path = $('#createLink_path').val();

    let fd = new FormData();
    fd.append('action', 'create');
    fd.append('title',title);
    fd.append('link_path',link_path);

    $.ajax({
        url: 'links/linksHandler.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            console.log(response);
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

    $.post("links/linksHandler.php",
        {
            action: 'single',
            id: id
        },
        function(data){
        console.log(data);
            let infomation = JSON.parse(data);
            $('#title').val(infomation['title']);
            $('#link_path').val(infomation['link_path']);
            $('#hiddenID').attr('value', infomation['id'])

        });
}

function updateRow(){
    let id = $('#hiddenID').val();
    let title = $('#title').val();
    let link_path = $('#link_path').val();

    let fd = new FormData();
    fd.append('action', 'update');
    fd.append('id',id);
    fd.append('title',title);
    fd.append('link_path',link_path);

    $.ajax({
        url: 'links/linksHandler.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            // console.log(response);
             let info = JSON.parse(response);
            if (info['status'] === "error")
                alert(info['message']);
            if (info['status'] === "success")
                location.reload();
        },
    });
}

function deleteConfirm(ele){
    $('#deleteConfirm').val(ele.getAttribute('value'));
}

function deleteRow(ele){
    let id = ele.getAttribute('value');

    $.post("links/linksHandler.php",
        {
            action: 'delete',
            id: id
        },
        function(data){
        console.log(data);
            location.reload();
        });
}

