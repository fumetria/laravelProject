<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;


/***
 * Muestra página accesible para los usuarios
 */
Route::get('/', function () {
    echo "Bienvenido";
});

/***
 * Muestra página accesible para los empleados
 */

Route::get('/main', function () {
    return view('main-dashboard');
});

/**
 * Muestra interfaz para dar de alta un prestamo de libro
 */
Route::get('/loans', function () {
    return view('loans-page');
});
/**
 * Muestra listado con los préstmos realizados (activos, devueltos, vencidos y no devueltros, etc.)
 */
Route::get('/loans/list', [LoanController::class, 'index']);

/**
 * Muestra detalle de información del préstamo seleccionado.
 */
Route::get('/loans/list/{id-loan}', [LoanController::class, 'show']);
/**
 * Crear nuevo préstamo de libro
 */
Route::get('/loans/new', [LoanController::class, 'create']);
Route::post('/loans/new', [LoanController::class, 'store']);

/**
 * Muestra interfaz de menú de gestión de usuarios(alta, baja, modificación, ¿es empleado?)
 */
Route::get('/users', function () {
    return view('users-dashboard');
});

Route::get('/users/list', [UserController::class, 'index']);
Route::get('/users/list/{id}', [UserController::class, 'show']);
Route::get('/users/list/add', [UserController::class, 'create']);
Route::post('/users/list/add', [UserController::class, 'store']);
Route::post('/users/list/{id}/update', [UserController::class, 'update']);
Route::post('/users/list/{id}/delete', [UserController::class, 'destroy']);

Route::get('/catalog/books', [BookController::class, 'index']);
Route::get('/catalog/books/{id}', [BookController::class, 'show']);
Route::get('/catalog/books/{id}/update', [BookController::class, 'index']);
Route::get('/catalog/books/{id}/delete', [BookController::class, 'show']);
