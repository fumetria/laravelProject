<?php


use App\Http\Controllers\AuthorController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Models\Book;
use App\Models\Author;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Carbon;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

Route::get('/', function () {
    return redirect('/welcome');
});

Route::get('/catalog', function () {
    return Inertia::render('CatalogView');
})->name('catalog');

Route::get('/welcome', function () {
    $author = Author::get()->random();
    return Inertia::render('Welcome', [
        'author' => $author,
    ]);
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->is_employee) {
            return redirect('/catalog');
        } else {
            return Inertia::render('Dashboard');
        };
    })->name('dashboard');

    /**
     * ROUTES FOR BOOKS
     */
    Route::get('/books', function () {
        return Inertia::render('Books/BooksList', [
            'books' => Book::get()
        ]);
    })->name('books');
    Route::get('/books/new', function () {
        return Inertia::render('Books/AddBook', [
            'authors' => Author::get()
        ]);
    })->name('newBook');
    Route::post('/books/store', [BookController::class, 'store']);
    Route::get('/books/editbook/{id_isbn}', function ($id_isbn) {
        return Inertia::render('Books/EditBook', [
            'book' => Book::find($id_isbn),
            'authors' => Author::get()
        ]);
    })->name('editBook');
    Route::post('books/update/{book}', [BookController::class, 'update'])->name('updateBook');
    Route::delete('/books/delete/{id_isbn}', [BookController::class, 'destroy'])->name('deleteBook');

    /**
     * ROUTES FOR AUTHORS
     */
    Route::get('/authors', function () {
        return Inertia::render('Authors/AuthorIndex',  [
            'authors' => Author::get()
        ]);
    })->name('authors');
    Route::get('/authors/new', function () {
        return Inertia::render('Authors/AddAuthor');
    })->name('addAuthorView');
    Route::post('/authors/store', [AuthorController::class, 'store']);
    // Route::post('/authors/delete/{id}', [AuthorController::class, 'delete']);
    // Route::post('/authors/update/{id}', [AuthorController::class, 'update']);

    /**
     * ROUTES FOR LOANS
     */
    Route::get('/loans', function () {
        return Inertia::render('Loans/LoansView', []);
    })->name('loans');
    Route::post('/loans/store', [LoanController::class, 'store']);
    Route::get('/loans/error', function () {
        return Inertia::render('Loans/LoansViewError', [
            'errorLoan' => 'Error, libro prestado',
        ]);
    })->name('loansError');
    Route::get('/loans/list', function () {
        return Inertia::render('Loans/LoansListView', [
            'loans' => Loan::get()
        ]);
    })->name('loansList');
    Route::get('/loans/return', function () {
        return Inertia::render('Loans/LoansReturn', [
            'loans' => Loan::orderBy('updated_at', 'desc')->get()
        ]);
    })->name('loansReturn');
    Route::post('/loans/finish', [LoanController::class, 'finish']);

    /**
     * ROUTES FOR USERS
     */
    Route::get('/users-pages', function () {
        return Inertia::render('Users/UsersView', [
            'users' => User::get()
        ]);
    })->name('usersList');
    Route::patch('/update/user/is-active/{id}', [UserController::class, 'updateIsActive'])->name('updateIsActive');
    /**
     *Statics
     */
    Route::get('/statics', function () {
        if (auth()->user()->is_admin == 1)
            return Inertia::render('StaticsView', [
                'users' => User::get()->count(),
                'numBooks' => Book::get()->count(),
                'authors' => Author::get()->count(),
                'loans' => Loan::get()->count(),
            ]);
    })->name('statics');
});

/**
 * For testing
 */

// Route::get('/barcode-test', function () {
//     $book = Book::get()->first();
//     $dns1d = new DNS1D();
//     $barcode = $dns1d->getBarcodeSVG($book->id_isbn, 'EAN13', 2, 40,);
//     return Inertia::render('BarcodeTest', [
//         'barcode' => $barcode,
//         'book' => $book
//     ]);
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function (){
//         Route::get('/loans/examen', function () {
//             if (auth()->user()->is_admin == 1) {
//                 $loans = Loan::get();
//                 $loansOrdered = usort($loans, function ($a, $b) {
//                     return Carbon::createFromFormat('Y-m-d H:i:s.u', $a->updated_at)->gt(Carbon::createFromFormat('Y-m-d H:i:s.u', $b->updated_at));
//                 });
//                 return Inertia::render('Loans/LoansListExamenView', [
//                     'loans' => Loan::oldest('updated_at')->get(),
//                     'loans' => $loansOrdered,
//                 ]);
//             }
//         })->name('loansExamen');
//     }
// );

   