<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/mesas-disponiveis', [App\Http\Controllers\ReservaController::class, 'mesasDisponiveis']);
    Route::get('/horarios-disponiveis', [App\Http\Controllers\ReservaController::class, 'horariosDisponiveis']);
    Route::post('/reserva', [App\Http\Controllers\ReservaController::class, 'fazerReserva']);
});
