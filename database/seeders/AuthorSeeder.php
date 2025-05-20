<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(base_path('/data_example/books.json'));
        if ($json === false){
            echo "Error al obtener datos";
        
        } else {
            $books = json_decode($json, true);
            foreach ($books as $book) {
                $newAuthor = new Author();
                $newAuthor->name = $book['author_name'];
                $newAuthor->biography = $book['biography'];
                $newAuthor->profile_url = $book['profile_url'];
                $newAuthor->save();
            }
        }
    }
}
