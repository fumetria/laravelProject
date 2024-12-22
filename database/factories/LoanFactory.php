<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Employee;
use App\Models\User;
use App\Models\Loan;

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
        $userId = User::inRandomOrder()->first()->id;
        $employeeId = Employee::inRandomOrder()->first()->id;
        $book = Book::inRandomOrder()->first()->id;
        $date = now();
        return [
            'loan_start_date' => $date,
            'id_isbn' => $book,
            'user_id' => $userId,
            'loan_end_date' => $date->addDays(rand(1, 9)),
            'loan_due_date' => $date->addDays(7),
            'employee_id' => $employeeId,
        ];
    }
}
