<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompeticionController;
use App\Http\Controllers\CopaController;
use App\Http\Controllers\UbicacionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Lectura pública
Route::resource('competicions', CompeticionController::class);
Route::resource('copas', CopaController::class)->only(['index','show']);
Route::resource('ubicacions', UbicacionController::class)->only(['index','show']);
