<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Employee;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Carbon;
use App\Http\Controllers\BookControllerApi;


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
        BookControllerApi::updateStatus(Book::find($book), 'Prestado');
        $date = Carbon::now();
        $end_date = Carbon::now()->addDays(rand(1, 9));
        $due_date = Carbon::now()->addDays(7);
        if ($end_date === '') {
            $status = 'activo';
        } else {
            $status = $end_date->diffInDays($due_date) < 0 ? 'Demorado' : 'Vencido';
        }
        return [
            'loan_start_date' => $date,
            'book_id_isbn' => $book,
            'user_id' => $userId,
            'loan_end_date' => $end_date,
            'loan_due_date' => $due_date,
            'loan_status' => $status,
            'employee_id' => $employeeId,
        ];
    }
}
