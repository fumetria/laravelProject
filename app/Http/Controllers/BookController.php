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
        $query = $request->input('query');
        $book = Book::orWhere('id', 'like', "%{$query}%")
            ->orWhere('id_isbn', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->orWhere('isbn', 'like', "%{$query}%")
            ->orWhere('genre', 'like', "%{$query}%")
            ->orWhere('publisher', 'like', "%{$query}%")
            ->orWhere('status', 'like', "%{$query}%")
            ->get();

        // $book = Book::where('id_isbn', 'like', "%{$query}%")
        //     ->get();
        return response()->json([
            'input' =>  $query . " " . "%{$query}%",
            $book
        ]);
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
}
