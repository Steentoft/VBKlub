<?php include "templates/header.php";

 include "BL/dbConnections/dbConnection.php";
 global $conn;
 include "adminpanel/bestyrelse/Bestyrelse.php";

 $members = Bestyrelse::Load();

?>

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
    <?php
    foreach ($members as $member)
    {
    ?>
    <div class="col-4 member justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="billeder/bestyrelse/<?php echo $member['picture_path'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5><?php echo $member['title'] ?></h5>
                <p class="card-text"><?php echo $member['fullname'] ?></p>
                <p class="card-text">Mobil: <?php echo $member['phonenumber'] ?></p>
                <a href = "mailto: <?php echo $member['email'] ?>"><?php echo $member['email'] ?></a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

</div>


<?php include "templates/footer.php"; ?>