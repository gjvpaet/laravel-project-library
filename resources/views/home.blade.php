@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="alert alert-success alert-dismissible hidden" role="alert" id="success-alert">
            <button class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> You successfully added a new book.
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Books</div>
                <div class="panel-body">
                    {{-- <input type="button" value="Add New Book" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" id="add-new-book"> --}}
                    <button class="btn btn-primary" id="add-new-book" data-toggle="modal" data-target=".bs-example-modal-lg" type="button">
                        <span class="glyphicon glyphicon-plus"></span> Add New Book
                    </button>
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="my-modal">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add New Book</h4>
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
                                        <div class="col-md-2">
                                            <input type="submit" value="Save" class="btn btn-primary" id="save-btn">
                                        </div>
                                        {{ csrf_field() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <tr>
                                <th>{{ $book->id }}</th>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->genre }}</td>
                                <td>{{ $book->library_section }}</td>
                                <td>{{ $book->created_at }}</td>
                                <td>{{ $book->updated_at }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/store.js"></script>
@endsection
