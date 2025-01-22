<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isbn = $this->faker->isbn13();
        $author = Author::inRandomOrder()->first()->id;
        return [
            'id_isbn' => $isbn . '000',
            'isbn' => $isbn,
            'title' => $this->faker->sentence(),
            'genre' => $this->faker->word(),
            'publisher' => $this->faker->sentence(2),
            'author_id' => $author,
            'location_floor' => $this->faker->randomNumber(1),
            'location_aisle' => $this->faker->randomNumber(1),
            'location_bookshelves' => $this->faker->randomNumber(1)
        ];
    }
}
