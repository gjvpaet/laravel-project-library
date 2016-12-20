var bookId = 0;
var action = '';

function removeErrorClass () {
    $('#title-div').removeClass('has-error');
    $('#title-help-block').text('');

    $('#author-div').removeClass('has-error');
    $('#author-help-block').text('');

    $('#genre-div').removeClass('has-error');
    $('#genre-help-block').text('');

    $('#library-section-div').removeClass('has-error');
    $('#library-section-help-block').text(''); 
}

function removeFieldValues () {
    $('#title').val('');
    $('#author').val('');
    $('#genre').val('');
    $('#library-section').val('');
}

function showFormGroup () {
    $('#action-btn-span').text(' Save');
    $('#action-btn-span').removeClass('glyphicon-trash');
    $('#action-btn-span').addClass('glyphicon-check');

    $('#action-btn').removeClass('btn-danger');
    $('#action-btn').addClass('btn-primary');

    $('.form-group').show();
    $('#delete-content').hide();
}

function showDeleteContent () {
    $('#action-btn-span').text(' Delete');
    $('#action-btn-span').removeClass('glyphicon-check');
    $('#action-btn-span').addClass('glyphicon-trash');

    $('#action-btn').removeClass('btn-primary');
    $('#action-btn').addClass('btn-danger');

    $('#delete-content').show();
    $('.form-group').hide();
}

// $('.add-book').click(function (e) { 
//     e.preventDefault();

//     showFormGroup();

//     $('#modal-title').text('Add New Book');
//     action = $(this).data('action');

//     removeErrorClass();
//     removeFieldValues();
// });

$('.panel-body').on('click', '.add-book', function () {
    showFormGroup();

    $('#modal-title').text('Add New Book');
    action = $(this).data('action');

    removeErrorClass();
    removeFieldValues();
});

// $('.edit-book').click(function (e) { 
//     e.preventDefault();
    
//     showFormGroup();

//     $('#modal-title').text('Edit Book');
//     action = $(this).data('action');

//     bookId = $(this).data('id');
//     $('#title').val($(this).data('title'));   
//     $('#author').val($(this).data('author'));
//     $('#genre').val($(this).data('genre'));
//     $('#library-section').val($(this).data('library-section'));

//     removeErrorClass(); 
// });

$(document).on('click', '.edit-book', function () {
    showFormGroup();

    $('#modal-title').text('Edit Book');
    action = $(this).data('action');

    bookId = $(this).data('id');
    $('#title').val($(this).data('title'));   
    $('#author').val($(this).data('author'));
    $('#genre').val($(this).data('genre'));
    $('#library-section').val($(this).data('library-section'));

    removeErrorClass(); 
});

// $('.delete-book').click(function (e) { 
//     e.preventDefault();
    
//     showDeleteContent();

//     $('#modal-title').text('Delete Book');
//     $('#title-span').text($(this).data('title'));
//     action = $(this).data('action');

//     bookId = $(this).data('id');
// });

$(document).on('click', '.delete-book', function () {
    showDeleteContent();

    $('#modal-title').text('Delete Book');
    $('#title-span').text($(this).data('title'));
    action = $(this).data('action');

    bookId = $(this).data('id');
});

$('#action-btn').click(function (e) {
    e.preventDefault();

    if (action == 'add') {
        $.ajax({
            type: 'POST',
            url: 'books',
            data: {
                _token: $('input[name="_token"]').val(),
                title: $('#title').val(),
                author: $('#author').val(),
                genre: $('#genre').val(),
                librarySection: $('#library-section').val()
            },
            dataType: 'json',
            success: function (response) {
                if (response.errors) {
                    if (response.errors.title) {
                        $('#title-div').addClass('has-error');
                        $('#title-help-block').text(response.errors.title);
                    } else {
                        $('#title-div').removeClass('has-error');
                        $('#title-help-block').text('');
                    }

                    if (response.errors.author) {
                        $('#author-div').addClass('has-error');
                        $('#author-help-block').text(response.errors.author);
                    } else {
                        $('#author-div').removeClass('has-error');
                        $('#author-help-block').text('');
                    }

                    if (response.errors.genre) {
                        $('#genre-div').addClass('has-error');
                        $('#genre-help-block').text(response.errors.genre);
                    } else {
                        $('#genre-div').removeClass('has-error');
                        $('#genre-help-block').text('');
                    }

                    if (response.errors.librarySection) {
                        $('#library-section-div').addClass('has-error');
                        $('#library-section-help-block').text(response.errors.librarySection);
                    } else {
                        $('#library-section-div').removeClass('has-error');
                        $('#library-section-help-block').text('');
                    }
                } else {
                    removeErrorClass(); 

                    var rowCount = $('#table tr').length;
                    if (rowCount < 10) {
                        $('#table').append("<tr id='item-" + response.id + "'>" + "<th>" + response.id + "</th><td>" + response.title + "</td><td>" + response.author + "</td><td>" + response.genre + "</td><td>" + response.library_section + "</td><td>" + response.created_at + "</td><td>" + response.updated_at + "</td><td>" + "<button class='btn btn-primary edit-book' id='edit-book-btn' type='button' data-toggle='modal' data-target='.bs-example-modal-lg' data-id='" + response.id + "' data-title='" + response.title + "' data-author='" + response.author + "' data-genre='" + response.genre + "' data-library-section='" + response.library_section + "' data-action='edit'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='btn btn-danger delete-book' id='delete-book-btn'><span class='glyphicon glyphicon-trash'></span> Delete</button>" + "</td>" + "</tr>");   
                    }

                    removeFieldValues();

                    $('#success-alert').removeClass('hidden');
                    $('#alert-message').text('You successfully added a new book.');
                    //$('#my-modal').modal('hide');
                }
            }, 
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(xhr.responseText);
                alert(thrownError);
            }
        });   
    } else if (action == 'edit') {
        $.ajax({
            type: 'PUT',
            url: 'books/' + bookId,
            data: {
                _token: $('input[name="_token"]').val(),
                title: $('#title').val(),
                author: $('#author').val(),
                genre: $('#genre').val(),
                librarySection: $('#library-section').val()
            },
            dataType: 'json',
            success: function (response) {
                if (response.errors) {
                    if (response.errors.title) {
                        $('#title-div').addClass('has-error');
                        $('#title-help-block').text(response.errors.title);
                    } else {
                        $('#title-div').removeClass('has-error');
                        $('#title-help-block').text('');
                    }

                    if (response.errors.author) {
                        $('#author-div').addClass('has-error');
                        $('#author-help-block').text(response.errors.author);
                    } else {
                        $('#author-div').removeClass('has-error');
                        $('#author-help-block').text('');
                    }

                    if (response.errors.genre) {
                        $('#genre-div').addClass('has-error');
                        $('#genre-help-block').text(response.errors.genre);
                    } else {
                        $('#genre-div').removeClass('has-error');
                        $('#genre-help-block').text('');
                    }

                    if (response.errors.librarySection) {
                        $('#library-section-div').addClass('has-error');
                        $('#library-section-help-block').text(response.errors.librarySection);
                    } else {
                        $('#library-section-div').removeClass('has-error');
                        $('#library-section-help-block').text('');
                    }
                } else {
                    removeErrorClass();

                    $('#item-' + response.id).replaceWith("<tr id='item-" + response.id + "'>" + "<th>" + response.id + "</th><td>" + response.title + "</td><td>" + response.author + "</td><td>" + response.genre + "</td><td>" + response.library_section + "</td><td>" + response.created_at + "</td><td>" + response.updated_at + "</td><td>" + "<button class='btn btn-primary edit-book' id='edit-book-btn' type='button' data-toggle='modal' data-target='.bs-example-modal-lg' data-id='" + response.id + "' data-title='" + response.title + "' data-author='" + response.author + "' data-genre='" + response.genre + "' data-library-section='" + response.library_section + "' data-action='edit'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='btn btn-danger' id='delete-book-btn delete-book'><span class='glyphicon glyphicon-trash'></span> Delete</button>" + "</td>" + "</tr>");

                    $('#success-alert').removeClass('hidden');
                    $('#alert-message').text('You successfully updated a book');
                    //$('#my-modal').modal('hide');
                }
            }
        });
    } else if (action == 'delete') {
        $.ajax({
            type: 'DELETE',
            url: 'books/' + bookId,
            data: {
                _token: $('input[name="_token"]').val()
            },
            dataType: 'json',
            success: function (response) {
                $('#item-' + bookId).remove();

                $('#success-alert').removeClass('hidden');
                $('#alert-message').text('You successfully deleted a book');
                //$('#my-modal').modal('hide');
            }
        });
    }
});