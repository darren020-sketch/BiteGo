<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CanteenController;

// Halaman Utama Canteen
Route::get('/', [CanteenController::class, 'index'])->name('canteen.index');
Route::get('/canteen', [CanteenController::class, 'index'])->name('canteen.index.alt');