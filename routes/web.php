<?php

use App\Http\Controllers\authController;
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

Route::get('/', function () {
    return view('home');
});
Route::get('/karyawan', function () {
    return view('data-karyawan');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [authController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [authController::class, 'register'])->name('register');
