<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\penilaianController;
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
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [authController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [authController::class, 'register'])->name('register');

Route::get('/karyawan', [karyawanController::class, 'index'])->name('karyawan.index');

Route::get('/karyawan/add', [karyawanController::class, 'create'])->name('karyawan.create');
Route::get('/karyawan/edit/{id}', [karyawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/update/{id}', [karyawanController::class, 'update'])->name('karyawan.update');
Route::get('/karyawan/delete/{id}', [karyawanController::class, 'delete'])->name('karyawan.delete');
Route::post('/karyawan/add', [karyawanController::class, 'store'])->name('karyawan.store');

Route::get('/logout', [authController::class, 'logout'])->name('logout');

Route::get('/penilaian', [penilaianController::class, 'index'])->name('penilaian.index');

Route::post('/penilaian', [penilaianController::class, 'filter'])->name('penilaian.filter');
Route::get('/penilaian/form/{id}', [penilaianController::class, 'form'])->name('penilaian.form');
Route::post('/penilaian/form', [penilaianController::class, 'store'])->name('penilaian.store');
