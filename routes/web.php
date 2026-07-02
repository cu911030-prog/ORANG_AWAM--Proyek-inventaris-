<?php

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ============================================
// PUBLIC ROUTES (Tidak memerlukan autentikasi)
// ============================================

// Rute Authentication
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');

// ============================================
// PROTECTED ROUTES (Memerlukan autentikasi)
// ============================================

Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Mengarahkan halaman utama (/) langsung ke halaman barang
    Route::get('/', function () {
        return redirect('/barang');
    });

    // Rute untuk Dashboard
    Route::get('dashboard', [HalamanController::class, 'jadwal'])->name('dashboard');

    // Rute Resource untuk Barang (CRUD)
    Route::resource('barang', BarangController::class);

    // Route untuk menampilkan halaman formulir tambah barang
    Route::get('/barang/tambah', [BarangController::class, 'create'])->name('barang.create');

    // Route untuk memproses penyimpanan data dari formulir ke database
    Route::post('/barang/simpan', [BarangController::class, 'store'])->name('barang.store');
});