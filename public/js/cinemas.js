$(document).ready(function () {

    var urls = {
        addCinema: '/admin/cinema/add',
        editCinema: '/admin/cinema/edit',
        deleteCinema: '/admin/cinema/delete'
    }
    var table_rows = ''
    var number = 1
    var action = 0

    var cinema_id = 0

    function generateData() {
        $.ajax({
            type: "GET",
            url: "/admin/cinemas/getAll",
            success: function (response) {
                console.log(response)

                $.each(response, function (index, val) {

                    var editButton = '<button class="btn btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" id="editCinema' + val.cinema_id + '">Edit</button>'
                    var delButton = '<button class="btn btn btn-danger" id="delCinema' + val.cinema_id + '">Delete</button>'

                    $(document).on('click', 'button#editCinema' + val.cinema_id, editButton, function (e) {
                        e.preventDefault()

                        $('#cinemaName').val(val.cinema_name)
                        action = 1
                        cinema_id = val.cinema_id

                    });


                    $(document).on('click', 'button#delCinema' + val.cinema_id, delButton, function (e) {
                        e.preventDefault()
                        _delete(urls.deleteCinema, val.cinema_id)
                    });

                    table_rows += ` <tr> 
                                        <td>${number++}</td>
                                        <td>${val.cinema_id}</td>
                                        <td>${val.cinema_name}</td>
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


    $('#btn-add-cinema').click(function (e) {
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

    $('#cinema-form').submit(function (e) {
        e.preventDefault()

        data = $(this).serialize()

        switch (action) {
            case 1:
                edit(urls.editCinema + '?cinema_id=' + cinema_id, data)
                break
            case 2:
                add(urls.addCinema, data)
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
            data: { 'cinema_id': id },
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
