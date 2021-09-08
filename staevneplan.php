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
        $sql = "SELECT name, date, start_time, end_time, locations.location FROM conventions LEFT JOIN locations ON conventions.location = locations.id WHERE date >= '" . $today . "' LIMIT 5" ;
        $result = $conn->query($sql);
        if($result){
            $conventions=$result->fetch_all(MYSQLI_ASSOC);
        }
    }


$oldConventions = array();
if ($conn) {
    $sql = "SELECT name, date, start_time, end_time, locations.location FROM conventions LEFT JOIN locations ON conventions.location = locations.id WHERE date <= '" . $yesterday . "' LIMIT 5" ;
    $result = $conn->query($sql);
    if($result){
        $oldConventions=$result->fetch_all(MYSQLI_ASSOC);
    }
}

?>

<style>
    .h4-padding{
        padding: 2% 1% 0% 1%;
    }
</style>

<div class="table-responsive-sm">
    <h4 class="h4-padding">Kommende stævner</h4>
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


<div class="table-responsive-sm">
    <h4 class="h4-padding">Ældre stævner</h4>
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

<?php include "templates/footer.php"; ?>