/**
 * Sends POST request to update selected row
 */
$("form#loginForm").submit(function(e) {
    e.preventDefault();
    console.log("sdfsdf");
    var fd = new FormData(this);

    let username = $('#username').val();
    let password = $('#password').val();


    fd.append('action','verify')
    fd.append('username',username);
    fd.append('password',password);
    $.ajax({
        url: 'BL/verification/verify_login.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            let info = JSON.parse(response);
            if (info['status'] === "error")
                alert(info['message']);
            if (info['status'] === "success")
                location.assign('adminpanel');
        },
    });
});
