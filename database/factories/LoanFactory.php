<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::inRandomOrder()->first()->id->where('role', 'user');
        $employeeId = User::inRandomOrder()->first()->id->where('role', 'employee');
        $book = Book::inRandomOrder()->first()->id_isbn;
        $date = now();
        return [
            'loan_start_date' => $date,
            'id_isbn' => $book,
            'user_id' => $userId,
            'employee_id' => $employeeId,
            'loan_end_date' => $date->addDays($this->fake()->randomNumber(1)),
            'loan_due_date' => $date->addDays(7),
        ];
    }
}
