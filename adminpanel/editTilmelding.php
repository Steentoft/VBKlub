<?php
include "../templates/adminHeader.php";
include "../BL/dbConnections/dbConnection.php";
global $conn;

include "tilmelding/Tilmelding.php";
$content = null;//Tilmelding::Load();
$order   = array('\r\n', '\n', '\r' );
$replace = '<br />';
if ($content != null)
    $content['content'] = str_replace($order, "", $content['content']);
?>



<form>
    <textarea id="editor"> <?php //if ($content != null) echo stripslashes($content['content']); ?> </textarea>
</form>
<div class="btn-create">
<button class="btn btn-dark" onclick="Update();">Gem</button>
</div>



</div>

<?php include "../templates/javaScriptLinks.html"?>
<script>
    /**
     * When the DOM is ready execute the php load function
     */
    $(document).ready( function () {

        $.post("tilmelding/tilmeldingHandler.php",
            {
                action: 'load'
            },
            function(response){
                let info = JSON.parse(response);
                if (info['status'] === "error")
                    alert(info['message']);
                if (info['status'] === "success"){
                    let text = info['message'];
                    $('#editor').val(text);
                }
            });

    } );


    function Update(){
        tinyMCE.triggerSave();
        let content = $('#editor').val();

        $.post("tilmelding/tilmeldingHandler.php",
            {
                action: 'update',
                content: content
            },
            function(response){
                let info = JSON.parse(response);
                if (info['status'] === "error")
                    alert(info['message']);
                if (info['status'] === "success")
                    location.reload();
            });
    }
</script>

</body>
</html>