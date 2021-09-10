</div>

<!-- JavaScript -->
<?php include "javaScriptLinks.html"?>
<script>

    $('#loginForm').submit(function (){
        let username = $('#username').val();
        let password = $('#password').val();

        $.post("BL/verification/verify_login.php",
            {
                username: username,
                password: password
            },
            function(data){
                if (data == "true"){
                    window.location.href = "adminpanel/";
                } else {
                    alert('Forkert brugernavn eller kodeord.')
                }
            });

    });

</script>
</body>
</html>