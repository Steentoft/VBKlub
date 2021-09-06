<?php include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
global $conn;
include_once "../bin/Pictures.php";
$pictures = Pictures::Download();
foreach ($pictures as $picture){

?>


<div class="card" style="width: 18rem;">
  <img src="../<?php echo $picture['path']; ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $picture['title']; ?></h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><?php echo $picture['category']; ?></li>
    <li class="list-group-item"><?php echo $picture['date']; ?></li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

<?php }