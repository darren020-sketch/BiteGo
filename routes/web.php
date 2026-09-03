<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KantinController;

Route::get('/', function () {
    return redirect()->route('kantin.index');
});

// Route utama aplikasi kantin
Route::get('/kantin', [KantinController::class, 'index'])->name('kantin.index');
Route::post('/kantin', [KantinController::class, 'store'])->name('kantin.store');