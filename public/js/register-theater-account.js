$(document).ready(function () {

    $('#theater-account-register').submit(function (e) {

        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/admin/register/admin',
            data: data,
            success: function (response) {
                res = JSON.parse(response)

                if (res.error_message) {

                    if (res.error_message['email']) {
                        $('#_email').html(res.error_message['email']);
                    }

                    if (res.error_message['contact_number']) {
                        $('#contact_number').html(res.error_message['contact_number']);
                    }
                }


                if (res.status === 1) {
                    window.location.href = res.redirect_uri;
                }



            }
        });

    });




});