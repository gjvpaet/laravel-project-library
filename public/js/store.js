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

function removeFieldValues()
{
    $('#title').val('');
    $('#author').val('');
    $('#genre').val('');
    $('#library-section').val('');
}

$('#add-new-book').click(function (e) { 
    e.preventDefault();

    removeErrorClass();
    removeFieldValues();
});

// Add method
$('#save-btn').click(function (e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: 'books',
        data: {
            _token : $('input[name="_token"]').val(),
            title : $('#title').val(),
            author : $('#author').val(),
            genre : $('#genre').val(),
            librarySection : $('#library-section').val()
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
                    $('#table').append("<tr><th>" + response.id + "</th><td>" + response.title + "</td><td>" + response.author + "</td><td>" + response.genre + "</td><td>" + response.library_section + "</td><td>" + response.created_at + "</td><td>" + response.updated_at + "</td>" + "</tr>");   
                }

                removeFieldValues();

                $('#success-alert').removeClass('hidden');
                $('#my-modal').modal('hide');
            }
        }, 
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(xhr.responseText);
            alert(thrownError);
        }
    });
});