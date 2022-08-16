$(document).ready(function () {

    $('#theater-fill-up').submit(function (e) {
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/admin/register/theater',
            data: data,
            success: function (response) {
                res = JSON.parse(response)
                console.log(res)

                if (res.error_message) {

                    if (res.error_message['theater_name']) {
                        $('#theater_name').html(res.error_message['theater_name']);
                    }

                    if (res.error_message['building']) {
                        $('#_building').html(res.error_message['building']);
                    }

                    if (res.error_message['address']) {
                        $('#_address').html(res.error_message['address']);
                    }


                    if (res.error_message['floor']) {
                        $('#_floor').html(res.error_message['floor']);
                    }

                    if (res.error_message['business_license']) {
                        $('#business_license').html(res.error_message['business_license']);
                    }

                }


                if (res.status === 1) {
                    window.location.href = res.redirect_uri;
                }



            }
        });

    });




});