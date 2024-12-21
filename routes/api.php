<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Http\Controllers\BookControllerApi;
use App\Http\Controllers\UserControllerApi;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Muestra listado de libros en catálogo
 */
Route::get('/books', [BookControllerApi::class, 'index']);
/**
 * Muestra información del libro seleccionado
 */
Route::get('/books/{isbn}', [BookControllerApi::class, 'show']);

/**
 * Devuel el detalle de información del usuario
 */
Route::get('/users/{id}', [UserControllerApi::class, 'show']);
