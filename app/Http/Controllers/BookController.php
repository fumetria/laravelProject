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
        $validate = $request->validate([
            'isbn' => ['required'],
            'title' => ['required', 'string', 'max:128'],
            'genre' => ['required', 'string', 'max:128'],
            'publisher' => ['required', 'string', 'max:128'],
            'author_id' => ['required', 'numeric', 'integer', 'min:1', 'max:9999'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],

        ]);
        $coverPath = null;
        if ($request->file('cover')) {
            $validate['cover'] = $request->file('cover')->storeAs('covers', $request->isbn . '.' . $request->file('cover')->extension(), 'public');
            $coverPath = $request->file('cover')->storeAs('covers', $request->isbn . '.' . $request->file('cover')->extension(), 'public');
        }
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
        if(!is_null($coverPath)){
            $book->cover_url = $coverPath;
        }
        $book->save();

        return redirect()->route('books')->with('newBookMsg', 'Libro creado correctamente');
    }
    public static function updateStatus(Book $book, String $status)
    {
        $book->status = $status;
        $book->save();
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'id_isbn' => ['required'],
            'title' => ['required', 'string', 'max:128'],
            'genre' => ['required', 'string', 'max:128'],
            'publisher' => ['required', 'string', 'max:128'],
            'author_id' => ['required', 'numeric', 'integer', 'min:1', 'max:9999'],
            'cover_url' => ['nullable', 'string', 'max:128'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'location_floor' => ['required', 'numeric', 'integer', 'min:0', 'max:99'],
            'location_aisle' => ['required', 'numeric', 'integer', 'min:0', 'max:99'],
            'location_bookshelves' => ['required', 'numeric', 'integer', 'min:0', 'max:99'],
        ]);
        $coverPath = null;
        if (!is_null($request->file('cover'))) {
            $validate['cover'] = $request->file('cover')->storeAs('covers', $request->isbn . '.' . $request->file('cover')->extension(), 'public');
            $coverPath = $request->file('cover')->storeAs('covers', $request->isbn . '.' . $request->file('cover')->extension(), 'public');
        }
        $book = Book::find($request->id_isbn);
        $book->id_isbn = $request->id_isbn;
        $book->title = $request->title;
        $book->genre = $request->genre;
        $book->publisher = $request->publisher;
        $book->author_id = $request->author_id;
        if(!is_null($coverPath)){
            $book->cover_url = $coverPath;
        }
        $book->location_floor = $request->location_floor;
        $book->location_aisle = $request->location_aisle;
        $book->location_bookshelves = $request->location_bookshelves;
        $book->save();
        return redirect()->route('books')->with('updateBookMsg', 'Libro actualizado correctamente');
    }

    public function destroy($id_isbn)
    {
        $book = Book::find($id_isbn);
        $book->delete();
        return redirect()->route('books');
    }

    public static function show($isbn)
    {
        $book = Book::find($isbn);

        if (!$book) {
            return 'Libro no encontrado';
        }

        return $book;
    }

    public static function getStatics()
    {
        //$numBooks = Book::get()->count();
        dd(Book::get()->count());
        return $numBooks;
    }
}
