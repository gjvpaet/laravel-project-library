<?php

use Library\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book1 = new Book();
        $book1->title = 'Android fully loaded';
        $book1->author = 'Rob Huddleston';
        $book1->genre = 'Technology';
        $book1->library_section = 'Circulation';
        $book1->save();

        $book2 = new Book();
        $book2->title = 'Android how to program';
        $book2->author = 'Paul Deitel';
        $book2->genre = 'Technology';
        $book2->library_section = 'Circulation';
        $book2->save();

        $book3 = new Book();
        $book3->title = 'Expert PHP and MySQL';
        $book3->author = 'Andrew Curioso';
        $book3->genre = 'Technology';
        $book3->library_section = 'Circulation';
        $book3->save();

        $book4 = new Book();
        $book4->title = 'Android for the absolute beginner';
        $book4->author = 'Lakshmi Prayaga';
        $book4->genre = 'Technology';
        $book4->library_section = 'Circulation';
        $book4->save();

        $book5 = new Book();
        $book5->title = 'Android application development';
        $book5->author = 'Barry Burd';
        $book5->genre = 'Technology';
        $book5->library_section = 'General References';
        $book5->save();

        $book6 = new Book();
        $book6->title = 'Divergent';
        $book6->author = 'Veronica Roth';
        $book6->genre = 'Young Adult';
        $book6->library_section = 'Fiction';
        $book6->save();

        $book7 = new Book();
        $book7->title = 'Insurgent';
        $book7->author = 'Veronica Roth';
        $book7->genre = 'Young Adult';
        $book7->library_section = 'Fiction';
        $book7->save();
    }
}
