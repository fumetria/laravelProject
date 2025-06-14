<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $book = BookController::show($request->id_isbn);
        if ($book) {
            if ($book->status === 'Disponible') {
                $loan->loan_start_date = $date;
                $loan->id_isbn = $book->id_isbn;
                $loan->user_id = $request->user_id;
                $loan->loan_due_date = Carbon::now()->addDays(7);
                $loan->loan_status = 'En vigor';
                $loan->employee_id = Auth::id();
                $loan->save();
                BookController::updateStatus($book, 'Prestado');
            } else {
                $errorLoan = 'Error, libro prestado';
                return redirect()->route('loansError');
            }
        }
        return redirect()->route('loansList');
    }

    public function show($id_isbn)
    {
        $loan = Loan::where('id_isbn', $id_isbn)->first();

        if (!$loan) {
            return 'Préstamo no encontrado';
        }
        return response()->json($loan);
    }

    public function finish(Request $request)
    {

        Loan::where('id_isbn', 'like', strtolower($request->id_isbn))->update([
            'loan_end_date' => Carbon::now(),
            'loan_status' => 'Vencido'
        ]);
        Book::where('id_isbn', 'like', strtolower($request->id_isbn))->update([
            'status' => 'Disponible'
        ]);

        return redirect()->route('loans');
    }

    public static function getStatics()
    {
        $numLoans = Loan::get()->count();
        return $numLoans;
    }
}
