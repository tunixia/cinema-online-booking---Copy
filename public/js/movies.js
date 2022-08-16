$(document).ready(function () {

    var urls = {
        addMovie: '/admin/movie/add',
        editMovie: '/admin/movie/edit',
        deleteMovie: '/admin/movie/delete'
    }
    var table_rows = ''
    var number = 1
    var action = 0
    var movie_id = 0
    function generateData() {

        $.ajax({
            type: "GET",
            url: "/admin/movies/getAll",
            success: function (response) {
                console.log(response)

                $.each(response, function (index, val) {

                    var editButton = '<button class="btn btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg" id="editMovie' + val.movie_id + '">Edit</button>'
                    var delButton = '<button class="btn btn btn-danger" id="delMovie' + val.movie_id + '">Delete</button>'

                    $(document).on('click', 'button#editMovie' + val.movie_id, editButton, function (e) {
                        e.preventDefault()

                        $('#title').val(val.title)
                        $('#directors').val(val.directors)
                        $('#casts').val(val.casts)
                        $('#description').val(val.description)
                        $('#genres').val(val.genres)
                        $('#poster').val(val.poster)
                        $('#trailer').val(val.trailer)
                        $('#length').val(val.length)
                        $('#price').val(val.price)
                        $('#rated').val(val.rated)

                        action = 1
                        movie_id = val.movie_id
                    });


                    $(document).on('click', 'button#delMovie' + val.movie_id, delButton, function (e) {
                        e.preventDefault()
                        _delete(urls.deleteMovie, val.movie_id)
                    });

                    table_rows += ` <tr> 
                                            <td>${number++}</td>
                                            <td>${val.movie_id}</td>
                                            <td>${val.title}</td>
                                            <td>${val.directors}</td>
                                            <td>${val.genres}</td>
                                            <td>${val.rated}</td>
                                            <td>${val.price}</td>
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


    $('#btn-add-movie').click(function (e) {
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

    $('#movie-form').submit(function (e) {
        e.preventDefault()

        data = $(this).serialize()
        switch (action) {
            case 1:
                edit(urls.editMovie + '?movie_id=' + movie_id, data)
                break
            case 2:
                add(urls.addMovie, data)
        }

    });



    function edit(url, data) {
        console.log('edit')
        console.log(data)
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
            data: { 'movie_id': id },
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
        if (res.title) {
            $('#title').addClass('border-red')
            $('#_title').html(res.title).addClass('text-danger')
        } else {
            $('#title').removeClass('border-red')
            $('#_title').html('').removeClass('text-danger')
        }

        if (res.description) {
            $('#description').addClass('border-red')
            $('#_description').html(res.description).addClass('text-danger')
        } else {
            $('#description').removeClass('border-red')
            $('#_description').html('').removeClass('text-danger')
        }

        if (res.directors) {
            $('#directors').addClass('border-red')
            $('#_directors').html(res.directors).addClass('text-danger')
        } else {
            $('#directors').removeClass('border-red')
            $('#_directors').html('').removeClass('text-danger')
        }

        if (res.casts) {
            $('#casts').addClass('border-red')
            $('#_casts').html(res.casts).addClass('text-danger')
        } else {
            $('#casts').removeClass('border-red')
            $('#_casts').html('').removeClass('text-danger')
        }

        if (res.genres) {
            $('#genres').addClass('border-red')
            $('#_genres').html(res.genres).addClass('text-danger')
        } else {
            $('#genres').removeClass('border-red')
            $('#_genres').html('').removeClass('text-danger')
        }

        if (res.rated) {
            $('#rated').addClass('border-red')
            $('#_rated').html(res.rated).addClass('text-danger')
        } else {
            $('#rated').removeClass('border-red')
            $('#_rated').html('').removeClass('text-danger')
        }

        if (res.price) {
            $('#price').addClass('border-red')
            $('#_price').html(res.price).addClass('text-danger')
        } else {
            $('#price').removeClass('border-red')
            $('#_price').html('').removeClass('text-danger')
        }

        if (res.length) {
            $('#length').addClass('border-red')
            $('#_length').html(res.length).addClass('text-danger')
        } else {
            $('#length').removeClass('border-red')
            $('#_length').html('').removeClass('text-danger')
        }

        if (res.trailer) {
            $('#trailer').addClass('border-red')
            $('#_trailer').html(res.trailer).addClass('text-danger')
        } else {
            $('#trailer').removeClass('border-red')
            $('#_trailer').html('').removeClass('text-danger')
        }

        if (res.poster) {
            $('#poster').addClass('border-red')
            $('#_poster').html(res.poster).addClass('text-danger')
        } else {
            $('#poster').removeClass('border-red')
            $('#_poster').html('').removeClass('text-danger')
        }

    }

    function clearInputs() {
        $('#movie-form').find('input, textarea').val('');
    }



    generateData()

});
