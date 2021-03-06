<?php include "templates/header.php";

include "BL/dbConnections/dbConnection.php";
global $conn;
//include "adminpanel/bestyrelse/Bestyrelse.php";
//
//$members = Bestyrelse::Load();

$today = date("Y-m-d");
$yesterday = date("Y-m-d", strtotime('-1 day', strtotime($today)));

    $conventions = array();
    if ($conn) {
        $sql = "SELECT name, date, start_time, end_time, locations.location FROM conventions LEFT JOIN locations ON conventions.location = locations.id WHERE date >= '" . $today . "'" ;
        $result = $conn->query($sql);
        if($result){
            $conventions=$result->fetch_all(MYSQLI_ASSOC);
        }
    }


$oldConventions = array();
if ($conn) {
    $sql = "SELECT name, date, start_time, end_time, locations.location FROM conventions LEFT JOIN locations ON conventions.location = locations.id WHERE date <= '" . $yesterday . "'" ;
    $result = $conn->query($sql);
    if($result){
        $oldConventions=$result->fetch_all(MYSQLI_ASSOC);
    }
}

?>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="nav-item"><a class="nav-link active" href="#upcoming" aria-controls="1" role="tab" data-toggle="tab">Kommende stævner</a></li>
    <li role="presentation" class="nav-item"><a class="nav-link" href="#old" aria-controls="2" role="tab" data-toggle="tab">Ældre stævner</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="upcoming" aria-labelledby="upcoming">

        <div class="table-responsive">
            <h4 class="h4-padding">Kommende stævner</h4>
            <table class="table table-striped" id="ComingConventions">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Navn</th>
                    <th scope="col">Dato</th>
                    <th scope="col">Tidspunkt</th>
                    <th scope="col">Lokation</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($conventions as $convention)
                {
                    ?>
                    <tr>
                        <td><?php echo $convention['name'] ?></td>
                        <td><?php echo $convention['date'] ?></td>
                        <td><?php echo date("H:i", strtotime($convention['start_time'])) . ' Til ' . date("H:i", strtotime($convention['end_time'])); ?></td>
                        <td><?php echo $convention['location'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>
    <div role="tabpanel" class="tab-pane" id="old" aria-labelledby="old">

        <div class="table-responsive">
            <h4 class="h4-padding">Ældre stævner</h4>
            <table class="table table-striped" id="FinishedConventions">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Navn</th>
                    <th scope="col">Dato</th>
                    <th scope="col">Tidspunkt</th>
                    <th scope="col">Lokation</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($oldConventions as $oldConvention)
                {
                    ?>
                    <tr>
                        <td><?php echo $oldConvention['name'] ?></td>
                        <td><?php echo $oldConvention['date'] ?></td>
                        <td><?php echo date("H:i", strtotime($oldConvention['start_time'])) . ' Til ' . date("H:i", strtotime($oldConvention['end_time'])); ?></td>
                        <td><?php echo $oldConvention['location'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>
</div>





<?php include "templates/footer.php"; ?>
<script>
    $(document).ready( function () {
        $('#FinishedConventions').dataTable({
            "dom": 'rtip',
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/da.json'
            }
        });
    } );
    $(document).ready( function () {
        $('#ComingConventions').dataTable({
            "dom": 'rtip',
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/da.json'
            },
            "order": [[ 1, "asc" ]]
        });
    } );
</script>
