@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="alert alert-success alert-dismissible hidden" role="alert" id="success-alert">
            <button class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> <span id="alert-message"></span>
        </div>
        <div class="col-lg-12" id="container">
            <div class="panel panel-default">
                <div class="panel-heading">All Books</div>
                <div class="panel-body">
                    <button class="btn btn-default" id="search-btn">
                        <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                    <div class="col-md-5" id="keyword-div">
                        <input type="text" class="form-control" id="search-keyword" placeholder="Search for title, author, genre, library section...">
                        <span class="help-block" id="keyword-help-block"></span>
                    </div>
                    <button class="btn btn-primary add-book" id="add-book-btn" data-toggle="modal" data-target=".bs-example-modal-lg" type="button" data-action="add">
                        <span class="glyphicon glyphicon-plus"></span> Add New Book
                    </button>
                </div>
                <table class="table table-responsive table-hover table-striped" id="table">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Library Section</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr id="item-{{ $book->id }}">
                                <th>{{ $book->id }}</th>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->genre }}</td>
                                <td>{{ $book->library_section }}</td>
                                <td>{{ $book->created_at }}</td>
                                <td>{{ $book->updated_at }}</td>
                                <td id="action-btn-td">
                                    <button class="btn btn-primary edit-book" id="edit-book-btn" type="button" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="{{ $book->id }}" data-title="{{ $book->title }}" data-author="{{ $book->author }}" data-genre="{{ $book->genre }}" data-library-section="{{ $book->library_section }}" data-action="edit">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    <button class="btn btn-danger delete-book" id="delete-book-btn" type="button" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="{{ $book->id }}" data-title="{{ $book->title }}" data-action="delete">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $books->links() }}
                </div>
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="my-modal">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row add">
                                    <div class="col-lg-12" id="title-div">
                                        <label for="title">Title:</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                        <span class="help-block" id="title-help-block"></span>
                                    </div>
                                    <div class="col-lg-12" id="author-div">
                                        <label for="author">Author:</label>
                                        <input type="text" class="form-control" id="author" name="author">
                                        <span class="help-block" id="author-help-block"></span>
                                    </div>
                                    <div class="col-lg-12" id="genre-div">
                                        <label for="genre">Genre:</label>
                                        <input type="text" class="form-control" id="genre" name="genre">
                                        <span class="help-block" id="genre-help-block"></span>
                                    </div>
                                    <div class="col-lg-12" id="library-section-div">
                                        <label for="library-section">Library Section:</label>
                                        <input type="text" class="form-control" id="library-section" name="library-section">
                                        <span class="help-block" id="library-section-help-block"></span>
                                    </div>
                                    {{ csrf_field() }}
                                </div>
                                <div id="delete-content">
                                    Are you sure you want to delete <span id="title-span"></span>? button 
                                </div>
                                <div class="modal-footer">
                                     <button type="button" class="btn" id="action-btn" data-dismiss="modal">
                                        <span id="action-btn-span" class="glyphicon"></span>
                                     </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/crud.js"></script>
<script type="text/javascript" src="/js/search.js"></script>
@endsection
