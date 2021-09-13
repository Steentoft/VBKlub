
/**
 * Enables sorting of the table
 */
$(document).ready( function () {
    $('#editGallery').DataTable( {
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

/**
 * Sends image src to modalPicture
 * @param img
 */
function showPicture(img){
    let imgPath = img.getAttribute('value');
    document.getElementById('modalPicture').setAttribute('src', imgPath);
}

/**
 * Inserts value to inputfields in modalEdit
 * @param ele
 */
function showEdit(ele){
    let id = ele.getAttribute('value');
    $.post("galleri/galleriHandler.php",
    {
        action: 'single',
        id: id
    },
    function(data){
        let infomation = JSON.parse(data);

        $('#title').val(infomation['title']);
        $('#category').val(infomation['category']);
        $('#date').val(infomation['date']);
        $('#chooseFileLabel').text(infomation['path']);
        $('#hiddenID').attr('value', infomation['id']);
        if (infomation['frontpageEnabled'] === 1)
            $('#checkFrontpage').prop('checked', true);
        else
            $('#checkFrontpage').prop('checked', false);
    });
}

/**
 * Send image id to deleteModal
 * @param ele
 */
function showDelete(ele){
    let id = ele.getAttribute('value');
    document.getElementById('deleteImage').setAttribute('value', id);
}

/**
 * Updates label associated to file input
 */
$('input:file').change(function(e){
    let fileName = e.target.files[0].name;
    let labelID = e.target.id+"Label";
    document.getElementById(labelID).innerHTML = fileName;
});

/**
 * Send a POST request to delete selected row
 * @param ele
 */
function deleteRow(ele){
    let id = ele.getAttribute('value');

    $.post("galleri/galleriHandler.php",
    {
        action: 'Delete',
        id: id
    },
    function(data){
        location.reload();
    });
}

/**
 * Sends POST request to update selected row
 */
$("form#edit").submit(function(e) {
    e.preventDefault();
    var fd = new FormData(this);

    let title = $('#title').val();
    let category = $('#category').val();
    let date = $('#date').val();
    let imageName = $('#chooseFileLabel').text();
    let id = $('#hiddenID').val();
    let frontpageEnabled = $('#checkFrontpage').is(":checked");


    //var fd = new FormData();
    fd.append('action', 'update');
    fd.append('id',id);
    fd.append('title',title);
    fd.append('category',category);
    fd.append('date',date);
    fd.append('fileName', imageName);
    fd.append('frontpageEnabled', frontpageEnabled);



    $.ajax({
        url: "galleri/galleriHandler.php",
        type: 'POST',
        data: fd,
        success: function () {
            location.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

/**
 * Sends POST request to create new row
 */
$("form#create").submit(function(e) {
    e.preventDefault();
    var fd = new FormData(this);

    let title = $('#createTitle').val();
    let category = $('#createCategory').val();
    let date = $('#createDate').val();
    let imageName = $('#createPictureLabel').text();
    let frontpageEnabled = $('#createCheckFrontpage').is(":checked");


    //var fd = new FormData();
    fd.append('action', 'Create');
    fd.append('title',title);
    fd.append('category',category);
    fd.append('date',date);
    fd.append('fileName', imageName);
    fd.append('frontpageEnabled', frontpageEnabled);



    $.ajax({
        url: "galleri/galleriHandler.php",
        type: 'POST',
        data: fd,
        success: function () {
            location.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

/**
 * Changes wheter or not the image should be shown on frontpage.
 * @param ele
 */
function changeState(ele){
    let sfp = ele.getAttribute('value');
    let id = document.getElementById('hiddenID').getAttribute('value');

    $.post("galleri/galleriHandler.php",
        {
            action: 'UpdateFrontpage',
            id: id,
            frontpageEnabled: sfp
        },
        function(data){
            location.reload();
        });
}