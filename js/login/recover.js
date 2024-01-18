function doCheckForm(form) {
    var allFilled = true;
    form.find('input').each(function () {
        if ($(this).val() == '') {
            allFilled = false;
        }
    });

    form.find(".btn").prop('disabled', !allFilled);
    if (allFilled) {
        form.find(".btn").removeAttr('disabled');
    }
}


$(document).ready(function () {

    $('input').keyup(function () {

        var currentForm = $(this).closest('form');
        console.log(currentForm.attr('id'))
        if (currentForm.attr('id') === 'recover_password_form') {
            doCheckForm(currentForm);
        } else if (currentForm.attr('id') === 'recover_username_form') {
            doCheckForm(currentForm);
        }
    });

    doCheckForm($('#recover_password_form'));
    doCheckForm($('#recover_username_form'));

    //option A
    $("form").submit(function (e) {
        alert('submit intercepted');
        e.preventDefault(e);
    });

    $('.switch').click(function () {
        console.log($('#recover_password_form').attr('hidden'));
        if ($('#recover_password_form').attr('hidden')) {
            $('#recover_password_form').attr('hidden', false);
            $('#recover_username_form').attr('hidden', true);
        } else {
            $('#recover_password_form').attr('hidden', true);
            $('#recover_username_form').attr('hidden', false);
        }
    })

});