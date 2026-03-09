<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\NotificacionController;
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
        $usuarios  = User::where('id', '!=', auth()->id())->orderBy('name')->get();
        $arbitros  = User::whereIn('rol', ['arbitro', 'admin'])->orderBy('name')->get();
        $competiciones = Competicion::with('arbitro', 'copa')->orderBy('fecha_realizacion')->get();
        return view('dashboard.admin', compact('usuarios', 'arbitros', 'competiciones'));
    }

    if ($user->isArbitro() && !$user->isAdmin()) {
        $competidores        = $user->competidoresAceptados()->get();
        $pendientes          = $user->competidoresPendientes()->get();
        $competicionesArbitradas = $user->competicionesArbitradas()->with('copa', 'ubicacion')->get();

        $userBuscado = null;
        if (request('dni')) {
            $userBuscado = User::where('dni', request('dni'))
                ->where('rol', 'competidor')
                ->first();
        }

        $misInscripciones = $user->competiciones()->with('copa', 'ubicacion')->get();
        $inscripcionesEquipo = collect();
        foreach ($competidores as $comp) {
            foreach ($comp->competiciones()->with('copa', 'ubicacion')->get() as $c) {
                $inscripcionesEquipo->push(['competicion' => $c, 'competidor' => $comp]);
            }
        }

        return view('dashboard.arbitro', compact(
            'competiciones', 'competicionesArbitradas', 'competidores', 'pendientes',
            'userBuscado', 'misInscripciones', 'inscripcionesEquipo'
        ));
    }

    if ($user->isEntrenador()) {
        $competidores = $user->competidoresAceptados()->get();
        $pendientes   = $user->competidoresPendientes()->get();

        $userBuscado = null;
        if (request('dni')) {
            $userBuscado = User::where('dni', request('dni'))
                ->where('rol', 'competidor')
                ->first();
        }

        $misInscripciones = $user->competiciones()->with('copa', 'ubicacion')->get();

        $inscripcionesEquipo = collect();
        foreach ($competidores as $comp) {
            foreach ($comp->competiciones()->with('copa', 'ubicacion')->get() as $c) {
                $inscripcionesEquipo->push(['competicion' => $c, 'competidor' => $comp]);
            }
        }

        return view('dashboard.entrenador', compact(
            'competiciones', 'competidores', 'pendientes',
            'userBuscado', 'misInscripciones', 'inscripcionesEquipo'
        ));
    }

    // Competidor: cargar entrenador actual y notificaciones pendientes
    $entrenador          = $user->entrenadores()->first();
    $notificaciones      = $user->unreadNotifications;

    return view('dashboard.competidor', compact('competiciones', 'entrenador', 'notificaciones'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'rol:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/usuarios', [AdminController::class, 'index'])->name('usuarios');
    Route::patch('/usuarios/{user}/rol', [AdminController::class, 'updateRol'])->name('usuarios.rol');
    Route::patch('/competiciones/{competicion}/arbitro', [AdminController::class, 'asignarArbitro'])->name('competiciones.arbitro');
});

Route::middleware(['auth', 'rol:entrenador'])->prefix('entrenador')->name('entrenador.')->group(function () {
    Route::post('/solicitar', [EntrenadorController::class, 'solicitarVinculo'])->name('solicitar');
    Route::delete('/competidor/{competidor}', [EntrenadorController::class, 'eliminarCompetidor'])->name('eliminar_competidor');
    Route::post('/inscribir', [EntrenadorController::class, 'inscribir'])->name('inscribir');
});

Route::middleware('auth')->prefix('notificaciones')->name('notificaciones.')->group(function () {
    Route::post('/{id}/aceptar', [NotificacionController::class, 'aceptar'])->name('aceptar');
    Route::delete('/{id}/rechazar', [NotificacionController::class, 'rechazar'])->name('rechazar');
    Route::delete('/desvincular', [NotificacionController::class, 'desvincular'])->name('desvincular');
});

require __DIR__.'/auth.php';
