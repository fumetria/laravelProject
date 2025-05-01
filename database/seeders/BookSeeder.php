<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // return Book::factory()->count(6)->create();
        $json = file_get_contents('../data_example/books.json');
        if ($json === false) {
            echo "Error al obtener datos";
        } else {
            $books = json_decode($json, true);
            foreach ($books as $book) {
                $newBook = new Book();
                $author = Author::where('name', $book['author_name'])->first();
                $newBook->id_isbn = $book['isbn'] . '000';
                $newBook->isbn = $book['isbn'];
                $newBook->title = $book['title'];
                $newBook->genre = $book['genre'];
                $newBook->publisher = $book['publisher'];
                $newBook->author_id = $author->id;
                $newBook->cover_url = $book['cover_url'];
                $newBook->save();
            }
        }
    }
}
