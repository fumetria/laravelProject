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
        $employeeId = User::inRandomOrder()->first()->id;
        $book = Book::where('status', 'Disponible')->inRandomOrder()->first();
        BookControllerApi::updateStatus(Book::find($book->id_isbn), 'Prestado');
        $date = Carbon::now();
        $end_date = Carbon::now()->addDays(rand(1, 9));
        $due_date = Carbon::now()->addDays(7);
        $status = '';
        if ($end_date === '' && $date->diffInDays($due_date) > 0) {
            $status = 'Activo';
        } else if ($end_date === '' && $date->diffInDays($due_date) < 0) {
            $status = 'Demorado';
        } else {
            $status = 'Vencido';
            BookControllerApi::updateStatus(Book::find($book->id_isbn), 'Disponible');
        }
        return [
            'loan_start_date' => $date,
            'id_isbn' => $book->id_isbn,
            'user_id' => $userId,
            'loan_end_date' => $end_date,
            'loan_due_date' => $due_date,
            'loan_status' => $status,
            'employee_id' => $employeeId,
        ];
    }
}
