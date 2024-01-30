<?php

use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ContenidoController::class, 'index']);
Route::get('/edit', [ContenidoController::class, 'edit']);
Route::post('/delete/{userId}', [ContenidoController::class, 'destroy']);
Route::get('/register', [ContenidoController::class, 'create']);
Route::get('/about', [ContenidoController::class, 'about']);


Route::post('/register', [userController::class, 'register']);
Route::post('/edit/user/{id}', [userController::class, 'edit']); 