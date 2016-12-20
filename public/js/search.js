$('#search-btn').click(function (e) { 
    e.preventDefault();
    
    $.ajax({
        type: 'POST',
        url: 'search',
        data: {
            _token: $('input[name="_token"]').val(),
            keyword: $('#search-keyword').val()
        },
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                $('#keyword-div').addClass('has-error');
                $('#keyword-help-block').text(response.error.keyword);   
            } else {
                $('#keyword-div').removeClass('has-error');
                $('#keyword-help-block').text('');

                $('tr').each(function () {
                    var id = this.id.split("-");

                    if (id[1] != 'undefined') {
                        $('#item-' + id[1]).remove();
                    }
                });

                $.each(response, function (indexInArray, valueOfElement) { 
                    $('#table').append("<tr id='item-" + valueOfElement.id + "'>" + "<th>" + valueOfElement.id + "</th><td>" + valueOfElement.title + "</td><td>" + valueOfElement.author + "</td><td>" + valueOfElement.genre + "</td><td>" + valueOfElement.library_section + "</td><td>" + valueOfElement.created_at + "</td><td>" + valueOfElement.updated_at + "</td><td>" + "<button class='btn btn-primary edit-book' id='edit-book-btn' type='button' data-toggle='modal' data-target='.bs-example-modal-lg' data-id='" + valueOfElement.id + "' data-title='" + valueOfElement.title + "' data-author='" + valueOfElement.author + "' data-genre='" + valueOfElement.genre + "' data-library-section='" + valueOfElement.library_section + "' data-action='edit'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='btn btn-danger delete-book' id='delete-book-btn'><span class='glyphicon glyphicon-trash'></span> Delete</button>" + "</td>" + "</tr>");
                });

                $('.pagination').hide();
            }
        }
    });
});