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
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'profile_url' => ['nullable', 'string', 'max:128'],
        ]);
        $profile_photo_path = null;
        if (!is_null($request->file('profile_photo'))) {
            $validate['profile_photo'] = $request->file('profile_photo')->storeAs('profile_photos', $request->name . '.' . $request->file('profile_photo')->extension(), 'public');
            $profile_photo_path = $request->file('profile_photo')->storeAs('profile_photos', $request->name . '.' . $request->file('profile_photo')->extension(), 'public');
        }
        $author = new Author();
        $author->name = $request->name;
        $author->biography = $request->biography;
        if(!is_null($profile_photo_path)){
            $author->profile_url = $profile_photo_path;
        }
        $author->save();

        return redirect()->route('authors');
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
