<?php

use App\Http\Controllers\HalamanController;
use Illuminate\Support\Facades\Route;

route::get('dashboard', [HalamanController::class, 'jadwal'])
    ->name('dashboard');

route::get('dashboard', [HalamanController::class, 'jadwal'])
    ->whereIn('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat',])
    ->name('jadwal.hari');

use App\Http\Controllers\BarangController;

Route::resource('barang', BarangController::class);
