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
        // $authors = [
        //     'Stephen King',
        //     'Agatha Christie',
        //     'J.K. Rowling',
        //     'George R.R. Martin',
        //     'Isaac Asimov',
        //     'Arthur Conan Doyle',
        //     'Dan Brown',
        //     'J.R.R. Tolkien',
        //     'H.P. Lovecraft',
        // ];
        // foreach ($authors as $authorName) {
        //     $author = new Author();
        //     $author->name = $authorName;
        //     $author->save();
        // }
        $json = file_get_contents('../data_example/books.json');
        if ($json === false){
            echo "Error al obtener datos";
        
        } else {
            $books = json_decode($json, true);
            foreach ($books as $book) {
                $newAuthor = new Author();
                $newAuthor->name = $book['author_name'];
                $newAuthor->save();
            }
        }
    }
}
