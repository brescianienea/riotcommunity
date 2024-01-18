function doCheck() {
    var allFilled = true;
    $('input').each(function () {
        if ($(this).val() == '') {
            allFilled = false;
        }
    });

    $("#submit").prop('disabled', !allFilled);
    if (allFilled) {
        $("#submit").removeAttr('disabled');
    }
}

$(document).ready(function () {

    doCheck();
    $('input').keyup(doCheck);

    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            if (!$('#submit').attr('disabled'))
                $('#submit').click();
            return false;

        }
    });

    //option A
    $("form").submit(function (e) {
        e.preventDefault(e);
        $.ajax({

            method: "POST",
            url: "/query/login/login.php",
            data: $(this).serialize(),
            success: function (data) {
                console.log(data);
                let result = JSON.parse(data);
                if (result['message'] === 'success') {
                    window.location.href = "login-page.php";
                } else {
                    alert(result['message']);
                }


            }

        });

    });

    document.getElementById('show-password').addEventListener('click', event => {
        event.preventDefault();

        var password = document.getElementById('password');
        if (password.type === 'password') {
            password.type = 'text';
            document.getElementById('show-password').classList.add('toggled');
        } else {
            password.type = 'password';
            document.getElementById('show-password').classList.remove('toggled');
        }

    });

});