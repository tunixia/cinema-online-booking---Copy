$(document).ready(function () {

    var urls = {
        addShow: '/admi/show/add',
        editShow: '/admin/show/edit',
        deleteShow: '/admin/show/delete'
    }

    var table_rows = ''
    var number = 1
    var action = 0

    var show_id = 0

    function generateData() {
        $.ajax({
            type: "GET",
            url: "/admin/shows/getAll",
            success: function (response) {
                console.log(response)

                $.each(response, function (index, val) {

                    var editButton = '<button class="btn btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" id="editShow' + val.show_id + '">Edit</button>'
                    var delButton = '<button class="btn btn btn-danger" id="delShow' + val.show_id + '">Delete</button>'

                    $(document).on('click', 'button#editCinema' + val.cinema_id, editButton, function (e) {
                        e.preventDefault()

                        $('#cinemaName').val(val.cinema_name)
                        action = 1
                        show_id = val.show_id

                    });


                    $(document).on('click', 'button#delCinema' + val.show_id, delButton, function (e) {
                        e.preventDefault()
                        _delete(urls.deleteShow, val.show_id)
                    });

                    table_rows += ` <tr> 
                                        <td>${number++}</td>
                                        <td>${val.title}</td>
                                        <td>${val.cinema_name}</td>
                                        <td>${val.start_at}</td>
                                        <td>${val.end_at}</td>
                                        <td>${val.created_at}</td>
                                        <td>${editButton}</td>
                                        <td>${delButton}</td>
                                    </tr>`

                });

                $('tbody').html(table_rows)
                table_rows = ''

            }
        });
    }


    $('#btn-add-show').click(function (e) {
        e.preventDefault();
        action = 2
    });

    $('#form-exit').click(function (e) {
        e.preventDefault()
        clearInputs()
    });


    $('#btn-cancel').click(function (e) {
        e.preventDefault()
        clearInputs()
    });

    $('#show-form').submit(function (e) {
        e.preventDefault()

        data = $(this).serialize()

        switch (action) {
            case 1:
                edit(urls.editCinema + '?show_id=' + show_id, data)
                break
            case 2:
                add(urls.addShow, data)
        }

    });



    function edit(url, data) {
        console.log('edit')
        console.log(data)
        console.log(cinema_id)
        console.log(url)

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (response) {
                console.log(response)
                generateData()
            },
            error: function (response) {

                var res = response.responseJSON
                console.log(res)
                filterInput(res)
            }
        });

    }

    function _delete(url, id) {

        $.ajax({
            type: "POST",
            url: url,
            data: { 'show_id': id },
            success: function (response) {
                console.log(response)
                generateData()
            },
            error: function (response) {

                var res = response.responseJSON
                console.log(res)

            }
        });

    }


    function add(url, data) {

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (response) {
                console.log(response)
                clearInputs()
                generateData()
            },
            error: function (response) {
                var res = response.responseJSON
                console.log(res)
                filterInput(res)
            }
        });
    }


    function filterInput(res) {
        if (res.cinema_name) {
            $('#cinemaName').addClass('border-red')
            $('#_cinemaName').html(res.cinema_name).addClass('text-danger')
        } else {
            $('#cinemaName').removeClass('border-red')
            $('#_cinemaName').html('').removeClass('text-danger')
        }
    }

    function removeInputEffects() {
        $('#cinemaName').removeClass('border-red')
        $('#_cinemaName').html('').removeClass('text-danger')
    }

    function clearInputs() {
        $('#cinema-form').find('input, textarea').val('');
        removeInputEffects()
    }



    generateData()


});
