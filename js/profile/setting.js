$(document).ready(function () {
    $('#logout').click(function () {
        $.ajax({
            method: "POST",
            url: "/query/profile/logout.php",
            success: function (data) {
                if (data === 'success') {
                    window.location.href = "index.php";
                }
            }
        });
    });
});