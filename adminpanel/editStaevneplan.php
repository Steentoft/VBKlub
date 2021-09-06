<?php include "../templates/header.php"; ?>

<div class="table-responsive-sm">
<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Navn</th>
        <th scope="col">Dato</th>
        <th scope="col">Tidspunkt</th>
        <th scope="col">Lokation</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Startsstævne 2021</td>
        <td>10. Oktober 2021</td>
        <td>Kl. 9:00 til 16:30</td>
        <td>Carl Nielsen Hallen</td>
    </tr>
    <tr>
        <td>Startsstævne 2020</td>
        <td>10. September 2020</td>
        <td>Kl. 9:00 til 16:30</td>
        <td>Carl Nielsen Hallen</td>
    </tr>
    <tr>
        <td>Startsstævne 2019</td>
        <td>17. Oktober 2019</td>
        <td>Kl. 9:00 til 16:30</td>
        <td>Carl Nielsen Hallen</td>
    </tr>
    </tbody>
</table>
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