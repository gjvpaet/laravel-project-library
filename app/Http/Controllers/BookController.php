<?php

namespace Library\Http\Controllers;

use DB;
use Validator;
use Library\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'librarySection' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        } else {
            $book = new Book();
            $book->title = $request->input('title');
            $book->author = $request->input('author');
            $book->genre = $request->input('genre');
            $book->library_section = $request->input('librarySection');
            $book->save();

            return response()->json($book);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'librarySection' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        } else {
            $book = Book::find($id);
            $book->title = $request->input('title');
            $book->author = $request->input('author');
            $book->genre = $request->input('genre');
            $book->library_section = $request->input('librarySection');
            $book->save();

            return response()->json($book);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find($id)->delete();

        return response()->json();
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $rules = ['keyword' => 'required'];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag()->toArray()
            ]);
        } else {
            $books = Book::where(DB::raw("CONCAT(title, ' ', author, ' ', genre, ' ', library_section)"), 'LIKE', "%{$keyword}%")->get();

            return response()->json($books);
        }
    }
}
