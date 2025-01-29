<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return Book::get();
    }

    public function search(Request $request)
    {
        if (!empty($request->input('filterType'))) {
            $filter = $request->input('filterType');
            $query = $request->input('query');
            $book = Book::where(strtolower($filter), 'like', strtolower("%$query%"))->get();
            return $book;
        } else {
            $query = $request->input('query');
            $book = Book::whereAny([
                'id',
                'id_isbn',
                'title',
                'author_id',
                'isbn',
                'genre',
                'publisher',
                'status'
            ], 'like', "%{$query}%")->get();
            return $book;
        }
    }

    public function store(Request $request)
    {
        $book = new Book();
        $book->isbn = $request->isbn;
        $book_id = '';
        if (!is_null(Book::where('isbn', $request->isbn))) {
            $dc = Book::where('isbn', $request->isbn)->count();
            if ($dc <= 9) {
                $dc = '00' . str($dc);
            } elseif ($dc <= 99) {
                $dc = '0' . str($dc);
            }
            $book_id = $request->isbn . $dc;
        } else {
            $book_id = $request->isbn . '001';
        }
        $book->id_isbn = $book_id;
        $book->title = $request->title;
        $book->genre = $request->genre;
        $book->publisher = $request->publisher;
        $book->author_id = $request->author_id;
        $book->cover_url = $request->cover_url;

        $book->save();

        // Book::Create($request->all());
        return redirect()->route('books');
    }
    public static function updateStatus(Book $book, String $status)
    {
        $book->status = $status;
        $book->save();
    }

    public static function show($isbn)
    {
        $book = Book::find($isbn);

        if (!$book) {
            return 'Libro no encontrado';
        }

        return $book;
    }
}
