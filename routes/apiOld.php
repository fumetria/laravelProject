<?php

use App\Http\Controllers\UserControllerApi;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Models\Book;

/**
 * Muestra listado de libros en catálogo
 */
Route::get('/books', [BookController::class, 'index']);
/**
 * Muestra información del libro seleccionado
 */
Route::get('/books/{id}', [BookController::class, 'show']);

/**
 * Devuel el detalle de información del usuario
 */
Route::get('/users/{id}', [UserControllerApi::class, 'show']);

Route::get('/books/all', function () {

    $books = Book::all();
    return response()->json([
        $books
    ]);
});
