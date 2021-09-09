let params = window.location.hash.substr(1).split('&');
let category = params[0];
let date = params[1];

$("#categorySelect").on('change', function(e) {
    e.preventDefault();

    category = $('#categorySelect').val();
    location.href = "#category="+category+"&date="+date;

    $.post("adminpanel/galleri/galleriHandler.php",
        {
            action: 'Select',
            date: date,
            category: category
        },
        function(data){

            let infomation = JSON.parse(data);

            let length = infomation.length

            for (let i=0;i<length;i++){
                if (i%2) {
                    displayImagesRight(infomation[i]);
                }else{
                    displayImagesLeft(infomation[i]);
                }
            }
        });

});

$("#dateSelect").on('change', function(e) {
    e.preventDefault();

    date = $('#dateSelect').val();
    location.href = "#category="+category+"&date="+date;

    $.post("adminpanel/galleri/galleriHandler.php",
        {
            action: 'Select',
            date: date,
            category: category
        },
        function(data){
            //console.log(data);
        });
});

function UpdatePicture(ele){
    let imgPath = ele.getAttribute('src');
    document.getElementById('modalPicture').setAttribute('src', imgPath);

    let id = ele.getAttribute('value');
    $.post("adminpanel/galleri/galleriHandler.php",
        {
            action: 'single',
            id: id
        },
        function(data){
            let infomation = JSON.parse(data);
            $('#title').text(infomation['title']+" - "+infomation['date']);
        });
}

function displayImagesLeft(image){
    $('#leftCol').append("<img value="+image['id']+" class='gallery-picture' src='billeder/"+image['category']+"/"+image['path']+"' onclick=UpdatePicture(this); data-toggle='modal' data-target='#exampleModal'>");
}

function displayImagesRight(image){
    $('#rightCol').append("<img value="+image['id']+" class='gallery-picture' src='billeder/"+image['category']+"/"+image['path']+"' onclick=UpdatePicture(this); data-toggle='modal' data-target='#exampleModal'>");
}