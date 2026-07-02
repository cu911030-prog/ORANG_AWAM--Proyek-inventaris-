<?php

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use Illuminate\Support\Facades\Route;

route::get('dashboard', [HalamanController::class, 'jadwal'])
    ->name('dashboard');

route::get('dashboard', [HalamanController::class, 'jadwal'])
    ->whereIn('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat',])
    ->name('jadwal.hari');

Route::resource('barang', BarangController::class);
Route::resource('barang-keluars', BarangKeluarController::class);
