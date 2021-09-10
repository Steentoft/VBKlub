<?php
include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
global $conn;

include "tilmelding/Tilmelding.php";
$content = Tilmelding::Load();
$order   = array('\r\n', '\n', '\r' );
$replace = '<br />';
$content['content'] = str_replace($order, "", $content['content']);
?>



<form>
    <textarea id="editor"> <?php echo stripslashes($content['content']); ?> </textarea>
</form>

<button class="btn btn-dark" style="margin: 1%" onclick="Update();">Gem</button>




</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>




    function Update(){
        tinyMCE.triggerSave();
        let content = $('#editor').val();

        $.post("tilmelding/tilmeldingHandler.php",
            {
                action: 'update',
                content: content
            },
            function(data){
                location.reload();
            });
    }
</script>

</body>
</html>