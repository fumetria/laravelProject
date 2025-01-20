<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->isbn = $request->isbn;
        if (Book::findOrFail($request->isbn)) {
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($isbn)
    {
        $book = Book::find($isbn);

        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }

        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    public static function updateStatus(Book $book, String $status)
    {
        $book->status = $status;
        $book->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }

    public function search(Request $request)
    {
        if (!empty($request->input('filterType'))) {
            $filter = $request->input('filterType');
            $query = $request->input('query');
            $book = Book::where(strtolower($filter), 'like', strtolower("%$query%"))->get();
            return response()->json($book);
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
            return response()->json($book);
        }
    }
}
