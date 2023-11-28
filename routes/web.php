<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\hasilPenilaianController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\kriteriaController;
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


Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [authController::class, 'login'])->name('login');

Route::match(['get', 'post'], '/logout', [authController::class, 'logout'])->name('logout');
Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [authController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {

    Route::get('/', [homeController::class, 'index'])->middleware('redirecttologin');
    Route::get('/karyawan', [karyawanController::class, 'index'])->name('karyawan.index');

    Route::get('/karyawan/add', [karyawanController::class, 'create'])->name('karyawan.create');
    Route::get('/karyawan/edit/{id}', [karyawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/update/{id}', [karyawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/{id}', [karyawanController::class, 'delete'])->name('karyawan.delete');
    Route::post('/karyawan/add', [karyawanController::class, 'store'])->name('karyawan.store');
    Route::get('/karyawan/cetak', [karyawanController::class, 'export'])->name('karyawan.cetak');


    Route::get('/penilaian', [penilaianController::class, 'index'])->name('penilaian.index');

    Route::post('/penilaian', [penilaianController::class, 'filter'])->name('penilaian.filter');
    Route::get('/penilaian/form/{id}', [penilaianController::class, 'form'])->name('penilaian.form');
    Route::get('/penilaian/edit/{id}', [penilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('/penilaian/edit/{id}', [penilaianController::class, 'update'])->name('penilaian.update');
    Route::post('/penilaian/form', [penilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian/cetak/{id}', [penilaianController::class, 'cetak'])->name('penilaian.cetak');

    Route::get('hasil-penilaian', [hasilPenilaianController::class, 'index'])->name('hasiPenilaian.index');
    Route::post('/hasil-penilaian', [hasilPenilaianController::class, 'filter'])->name('hasil.filter');

    Route::get('/kriteria', [kriteriaController::class, 'index'])->name('kriteria.index');
    Route::post('/kriteria/add', [kriteriaController::class, 'store'])->name('kriteria.store');
    Route::put('/kriteria/{id}', [kriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/kriteria/{id}', [kriteriaController::class, 'destroy'])->name('kriteria.delete');
});
