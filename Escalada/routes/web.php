<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\Competicion;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $competiciones = Competicion::query()
        ->where('fecha_realizacion', '>=', now())
        ->orderBy('fecha_realizacion')
        ->paginate(10);

    $user = auth()->user();

    if ($user->isAdmin()) {
        $usuarios = User::where('id', '!=', auth()->id())->orderBy('name')->paginate(20);
        return view('dashboard.admin', compact('competiciones', 'usuarios'));
    }

    if ($user->isArbitro()) {
        return view('dashboard.arbitro', compact('competiciones'));
    }

    return view('dashboard.competidor', compact('competiciones'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'rol:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/usuarios', [AdminController::class, 'index'])->name('usuarios');
    Route::patch('/usuarios/{user}/rol', [AdminController::class, 'updateRol'])->name('usuarios.rol');
});

require __DIR__.'/auth.php';
