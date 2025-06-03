<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Author::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'biography' => ['nullable', 'string', 'max:2048'],
            'profile_url' => ['nullable', 'string', 'max:128'],
        ]);
        $author = new Author();
        $author->name = $request->name;
        $author->biography = $request->biography;
        $author->profile_url = $request->profile_url;
        $author->save();

        return redirect()->route('newBook');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = Author::find($id);
        return $author;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }

    public static function getStatics()
    {
        $numAuthor = Author::get()->count();
        return $numAuthor;
    }
}
