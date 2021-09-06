<?php include "templates/header.php"; ?>

<style>
    p{
        margin-bottom: 0px !important;
    }
    .justify-content-center{
        display: flex;
    }
</style>

<h2 style="padding: 1%">Bestyrelse</h2>
<div class="row" style="padding: 1%">
    <div class="col-4 member justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="billeder/testbillede2.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5>Formand</h5>
                <p class="card-text">Maria Lorentsen</p>
                <p class="card-text">Mobil: 51600475</p>
                <a href = "mailto: m_lorentsen@hotmail.com">m_lorentsen@hotmail.com</a>
            </div>
        </div>
    </div>
    <div class="col-4 member justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="billeder/testbillede2.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5>Kasserer</h5>
                <p class="card-text">Torben Sonne Nielsen</p>
                <p class="card-text">Mobil: 60106183</p>
                <a href = "mailto: torben.sonne.nielsen@gmail.com">torben.sonne.nielsen@gmail.com</a>
            </div>
        </div>
    </div>
    <div class="col-4 member justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="billeder/testbillede2.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5>Næstformand</h5>
                <p class="card-text">Gustav Møller</p>
                <p class="card-text">Mobil: 28884891</p>
                <a href = "mailto: dk28884891@hotmail.com">dk28884891@hotmail.com</a>
            </div>
        </div>
    </div>
    <div class="col-4 member justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="billeder/testbillede2.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5>Bestyrelsesmedlem</h5>
                <p class="card-text">Erik Viggo Hansen</p>
                <p class="card-text">Mobil: 23466983</p>
                <a href = "mailto: hansen.viggo.erik@gmail.com">hansen.viggo.erik@gmail.com</a>
            </div>
        </div>
    </div>
    <div class="col-4 member justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="billeder/testbillede2.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5>IT-ansvarlig</h5>
                <p class="card-text">Brian Hansen</p>
                <p class="card-text">Mobil: 30256160</p>
                <a href = "mailto: briansh@hotmail.com">briansh@hotmail.com</a>
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