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
        $('#hiddenID').attr('value', infomation['id'])
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


    //var fd = new FormData();
    fd.append('action', 'update');
    fd.append('id',id);
    fd.append('title',title);
    fd.append('category',category);
    fd.append('date',date);
    fd.append('fileName', imageName);



    $.ajax({
        url: "galleri/galleriHandler.php",
        type: 'POST',
        data: fd,
        success: function (data) {
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


    //var fd = new FormData();
    fd.append('action', 'Create');
    fd.append('title',title);
    fd.append('category',category);
    fd.append('date',date);
    fd.append('fileName', imageName);



    $.ajax({
        url: "galleri/galleriHandler.php",
        type: 'POST',
        data: fd,
        success: function (data) {
            location.reload();
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
