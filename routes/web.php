<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookControllerApi;
use App\Http\Controllers\LoanController;
use App\Models\Book;
use App\Models\Author;
use App\Models\Loan;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/catalog', function () {
    return Inertia::render('CatalogView');
});

/**
 * Muestra información del libro seleccionado
 */
Route::get('/api/books/search/?query={isbn}&filterType=isbn', [BookControllerApi::class, 'search']);

// Route::get('/books', function () {
//     return Inertia::render('BooksList', [
//         'books' => Book::get()
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/books', function () {
        return Inertia::render('BooksList', [
            'books' => Book::get()
        ]);
    })->name('books');
    Route::get('/pruebas', function () {
        return Inertia::render('Pruebas', [
            'authors' => Author::get()
        ]);
    })->name('pruebas');
    Route::get('/books/new', function () {
        return Inertia::render('AddBook', [
            'authors' => Author::get()
        ]);
    })->name('newBook');
    Route::post('/books/store', [BookController::class, 'store']);
    Route::get('/loans', function () {
        return Inertia::render('LoansView', [
            // 'loans' => Loan::get()
        ]);
    })->name('loans');
    Route::post('/loans/store', [LoanController::class, 'store']);
    Route::get('/loans/list', function () {
        return Inertia::render('LoansListView', [
            'loans' => Loan::get()
        ]);
    })->name('loansList');
});
