<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Fungsi 1: profil usaha + proses pembuatan
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');

// Fungsi 2 dan 3: katalog, detail, tombol WhatsApp
Route::get('/katalog', [ProductController::class, 'index'])->name('katalog');
Route::get('/katalog/{id}', [ProductController::class, 'show'])->whereNumber('id')->name('product-detail');

// Fungsi 4: halaman admin ada di /admin (Filament)
