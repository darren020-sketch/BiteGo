<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CanteenController;

// Halaman Utama Canteen (Home Page)
Route::get('/', [CanteenController::class, 'index'])->name('canteen.index');
Route::get('/canteen', [CanteenController::class, 'index'])->name('canteen.index.alt');

// Halaman Daftar Menu berdasarkan Kategori
Route::get('/canteen/menu', [CanteenController::class, 'menu'])->name('canteen.menu');