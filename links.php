<?php include "templates/header.php";

include "BL/dbConnections/dbConnection.php";
global $conn;

$links = array();
if ($conn) {
    $sql = "SELECT * FROM links";
    $result = $conn->query($sql);
    if($result){
        $links = $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Links</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($links as $link)
                {
                    ?>
                    <tr>
                        <td><a href="<?php echo $link['link_path'] ?>"><?php echo $link['title'] ?></a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>





<?php include "templates/footer.php"; ?>
