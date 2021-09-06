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
</div>

<!-- JavaScript -->
<script>

    function UpdatePicture(ele){
        let imgPath = ele.getAttribute('src');
        document.getElementById('modalPicture').setAttribute('src', imgPath);
    }

</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>