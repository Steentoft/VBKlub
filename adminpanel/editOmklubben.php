<?php
    include "../templates/adminHeader.php";
    include "../BL/dbConnections/dbConnection.php";
    global $conn;

    include "omklubben/Omklubben.php";
    $response = Omklubben::Load();
    $content = "";
    if ($response['status'] == 'success')
        $content = $response['message'];
    elseif($response['status'] == 'error')
        echo '<script>alert("'.$response["message"].'");</script>';
    $order   = array('\r\n', '\n', '\r' );
    $replace = '<br />';
    if ($content != null)
        $content = str_replace($order, "", $content);
?>



<form>
    <textarea id="editor"> <?php if ($content != null) echo stripslashes($content); ?> </textarea>
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

        $.post("omklubben/omklubbenHandler.php",
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