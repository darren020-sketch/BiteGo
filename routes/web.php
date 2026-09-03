<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KantinController;

// Halaman Utama Kantin
Route::get('/', [KantinController::class, 'index'])->name('kantin.index');
Route::get('/kantin', [KantinController::class, 'index'])->name('kantin.index.alt');