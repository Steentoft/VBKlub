<?php include "templates/header.php"; ?>


    <div class="row content">
        <div class="row img-row">
            <div class="column img-column justify-content-center">
                <img class="gallery-picture" src="billeder/image0.jpeg" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">
                <img class="gallery-picture" src="billeder/image4.jpeg" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">
                <img class="gallery-picture" src="billeder/image3.jpeg" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">
            </div>
            <div class="column img-column justify-content-center">
                <img class="gallery-picture" src="billeder/image2.jpeg" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">
                <img class="gallery-picture" src="billeder/image1.jpeg" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">
                <img class="gallery-picture" src="billeder/image5.jpeg" onclick="UpdatePicture(this);" data-toggle="modal" data-target="#exampleModal">
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
    </div>

<!-- JavaScript -->
<script>

    function UpdatePicture(ele){
        let imgPath = ele.getAttribute('src');
        document.getElementById('modalPicture').setAttribute('src', imgPath);
    }

</script>
<?php include "templates/footer.php"; ?>