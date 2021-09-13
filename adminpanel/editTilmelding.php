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
<div class="btn-create">
<button class="btn btn-dark" onclick="Update();">Gem</button>
</div>



</div>

<?php include "../templates/javaScriptLinks.html"?>
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