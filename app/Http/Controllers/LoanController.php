<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Loan;
use App\Models\Book;
use App\Http\Controllers\BookController;

use function PHPUnit\Framework\isNull;

class LoanController extends Controller
{
    public function index()
    {
        return Loan::all();
    }

    public function store(Request $request)
    {

        $loan = new Loan();
        $date = Carbon::now();
        $book = Book::where('id_isbn', $request->id_isbn)->get();
        if (!isNull($book)) {
            BookController::updateStatus($book, 'Prestado');
        }
        $loan->loan_start_date = $date;
        $loan->book_id_isbn = $request->id_isbn;
        $loan->user_id = $request->user_id;
        $loan->loan_due_date = $date->addDays(7);
        $loan->loan_status = 'En vigor';
        $loan->employee_id = $request->employee_id;
        $loan->save();

        return redirect()->route('loansList');
    }
}
