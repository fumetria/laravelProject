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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::find($id);

        // if (!$book) {
        //     return response()->json(['message' => 'Libro no encontrado'], 404);
        // }

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
        $query = $request->input('query');
        $book = Book::orWhere('id', 'like', "%{$query}%")
            ->orWhere('id_isbn', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->orWhere('author_id', 'like', "%{$query}%")
            ->orWhere('isbn', 'like', "%{$query}%")
            ->orWhere('genre', 'like', "%{$query}%")
            ->orWhere('publisher', 'like', "%{$query}%")
            ->orWhere('status', 'like', "%{$query}%")
            ->get();
        return response()->json([
            $book
        ]);
    }
}
