<?php include "../templates/adminHeader.php"; ?>

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
        $sql = "SELECT * FROM members"


        ?>
        <tr>
            <td>Maria Lorentsen</td>
            <td>Formand</td>
            <td>51600475</td>
            <td>m_lorentsen@hotmail.com</td>
            <td><img style="margin: auto; display: flex" src="../billeder/image_icon.png"></td>
            <td><img style="margin: auto; display: flex" src="../billeder/edit_icon.png"></td>
            <td><img style="margin: auto; display: flex" src="../billeder/delete_icon.png"></td>
        </tr>
    </tbody>
</table>




</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>