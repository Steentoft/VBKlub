<?php
include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
    global $conn;
?>

<style>
    .img-row-show{
        margin: auto;
        display: flex;
        cursor: pointer;
    }

</style>

<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Navn</th>
        <th scope="col">Titel</th>
        <th scope="col">Mobil</th>
        <th scope="col">Email</th>
        <th style="text-align: center" scope="col">Billede</th>
        <th style="text-align: center" scope="col">Rediger</th>
        <th style="text-align: center" scope="col">Slet</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM members";
            $result = $conn->query($sql);
         while($row = $result->fetch_assoc()) {
             echo '<tr>';
             echo '<td>' . $row['fullname'] . '</td>';
             echo '<td>' . $row['title'] . '</td>';
             echo '<td>' . $row['phonenumber'] . '</td>';
             echo '<td>' . $row['email'] . '</td>';
             echo '<td><img class="img-row-show" value="../billeder/' . $row['picture_path'] . '" onclick="showPicture(this);" src="../billeder/image_icon.png" data-toggle="modal" data-target="#exampleModal"></td>';
             echo '<td><img class="img-row-show" src="../billeder/edit_icon.png"></td>';
             echo '<td><img class="img-row-show" src="../billeder/delete_icon.png"></td>';
             echo '</tr>';



         }
        ?>
    </tbody>
</table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
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

<script>
    function showPicture(ele){
        let imgPath = ele.getAttribute('value');
        document.getElementById('modalPicture').setAttribute('src', imgPath);
    }
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>