<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Http\Controllers\BookControllerApi;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserControllerApi;
use Barryvdh\Debugbar\Facades\Debugbar;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Muestra listado de libros en catálogo
 */
Route::get('/books', [BookControllerApi::class, 'index']);
/**
 * Busca cualquier coincidencia dentro de la BD
 */
Route::get('/books/search', [BookControllerApi::class, 'search']);
/**
 * Muestra información del libro seleccionado
 */
Route::get('/books/{id_isbn}', [BookControllerApi::class, 'show']);

/**
 * Devuel el detalle de información del usuario
 */
Route::get('/users/{id}', [UserControllerApi::class, 'show']);

Route::get('/loans', [LoanController::class, 'index']);

Route::get('/employees', [EmployeeController::class, 'index']);
