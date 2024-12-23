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
}
