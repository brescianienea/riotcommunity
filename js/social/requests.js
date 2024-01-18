$('.deny').on('click', function () {
    let data = {
        'user_id': $(this).attr('user_id')
    };
    $.ajax({

        method: "POST",
        url: "/query/user/deleteFriendRequest.php",
        data: data,
        success: function (data) {
            console.log(data);
            let result = JSON.parse(data);
            if (result['message'] === 'success') {

            } else {
                alert(result['message']);
            }


        }

    });
    location.reload();
});

$('.approve').on('click', function () {
    let data = {
        'user_id': $(this).attr('user_id')
    };
    $.ajax({

        method: "POST",
        url: "/query/user/addFriend.php",
        data: data,
        success: function (data) {
            console.log(data);
            let result = JSON.parse(data);
            if (result['message'] === 'success') {

            } else {
                alert(result['message']);
            }


        }

    });
    location.reload();
});