<?php

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

// Rute Dashboard & Jadwal (Sudah Diperbaiki URL-nya)
Route::get('dashboard', [HalamanController::class, 'jadwal'])->name('dashboard');
Route::get('dashboard/{hari}', [HalamanController::class, 'jadwal'])
    ->whereIn('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat'])
    ->name('jadwal.hari');

// Rute CRUD Modul Barang (Milik Umam)
Route::resource('barang', BarangController::class);

// Rute CRUD Modul Kategori & Satuan (Milik Resya)
Route::resource('kategori', KategoriController::class);
Route::resource('satuan', SatuanController::class);