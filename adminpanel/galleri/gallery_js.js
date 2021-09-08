
function showPicture(img){
    let imgPath = img.getAttribute('value');
    document.getElementById('modalPicture').setAttribute('src', imgPath);
}

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
        $('#uploadLabel').text(infomation['path']);
        $('#hiddenID').attr('value', infomation['id'])
    });
}

function showDelete(ele){
    let id = ele.getAttribute('value');
    document.getElementById('deleteImage').setAttribute('value', id);
}

$('input#chooseFile').change(function(e){
    let fileName = e.target.files[0].name;
    document.getElementById('uploadLabel').innerHTML = fileName;
});

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

$("form#data").submit(function(e) {
    e.preventDefault();
    var fd = new FormData(this);

    let title = $('#title').val();
    let category = $('#category').val();
    let date = $('#date').val();
    let imageName = $('#uploadLabel').text();
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
            alert(data)
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

function UpdateGallery(){


}
