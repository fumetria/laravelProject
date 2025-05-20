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
        $json = file_get_contents(base_path('/data_example/authors.json'));
        if ($json === false){
            echo "Error al obtener datos";
        
        } else {
            $authors = json_decode($json, true);
            foreach ($authors as $author) {
                $newAuthor = new Author();
                $newAuthor->name = $author['author_name'];
                $newAuthor->biography = $author['biography'];
                $newAuthor->profile_url = $author['profile_url'];
                $newAuthor->save();
            }
        }
    }
}
