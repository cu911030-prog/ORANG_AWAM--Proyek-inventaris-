<?php

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

// 1. Mengarahkan halaman utama (/) langsung ke halaman barang
Route::get('/', function () {
    return redirect('/barang');
});

// 2. Rute untuk Dashboard
Route::get('dashboard', [HalamanController::class, 'jadwal'])->name('dashboard');

// 3. Rute Resource untuk Barang (CRUD)
Route::resource('barang', BarangController::class);

// Route untuk menampilkan halaman formulir tambah barang
Route::get('/barang/tambah', [BarangController::class, 'create'])->name('barang.create');

// Route untuk memproses penyimpanan data dari formulir ke database
Route::post('/barang/simpan', [BarangController::class, 'store'])->name('barang.store');