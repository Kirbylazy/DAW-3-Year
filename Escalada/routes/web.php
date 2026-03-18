<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\ArbitroController;
use App\Http\Controllers\CopaController;
use App\Http\Controllers\CompeticionController;
use App\Http\Controllers\UbicacionController;
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
        return redirect()->route('admin.pruebas');
    }

    if ($user->isArbitro() && !$user->isAdmin()) {
        return redirect()->route('arbitro.panel');
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

    // Competidor: cargar entrenador actual, notificaciones y todas las competiciones
    $entrenador     = $user->entrenadores()->first();
    $notificaciones = $user->unreadNotifications;

    $competiciones = Competicion::with('copa', 'ubicacion')
        ->orderBy('fecha_realizacion', 'desc')
        ->paginate(12);

    $inscripciones = $user->inscripciones()
        ->whereIn('competicion_id', $competiciones->pluck('id'))
        ->get()
        ->keyBy('competicion_id');

    return view('dashboard.competidor', compact('competiciones', 'entrenador', 'notificaciones', 'inscripciones'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'rol:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/pruebas',    [AdminController::class, 'pruebas'])->name('pruebas');
    Route::get('/copas',      [AdminController::class, 'copas'])->name('copas');
    Route::get('/usuarios',   [AdminController::class, 'usuarios'])->name('usuarios');
    Route::get('/rocodromos', [AdminController::class, 'rocodromos'])->name('rocodromos');

    Route::patch('/usuarios/{user}',     [AdminController::class, 'actualizarUsuario'])->name('usuarios.update');
    Route::delete('/usuarios/{user}',    [AdminController::class, 'destroyUsuario'])->name('usuarios.destroy');
    Route::patch('/usuarios/{user}/rol', [AdminController::class, 'updateRol'])->name('usuarios.rol');

    Route::patch('/competiciones/{competicion}/arbitro',    [AdminController::class, 'asignarArbitro'])->name('competiciones.arbitro');
    Route::post('/competiciones',                            [CompeticionController::class, 'store'])->name('competiciones.store');
    Route::patch('/competiciones/{competicion}',             [CompeticionController::class, 'update'])->name('competiciones.update');
    Route::delete('/competiciones/{competicion}',            [CompeticionController::class, 'destroy'])->name('competiciones.destroy');
    Route::patch('/competiciones/{competicion}/campeonato',  [CompeticionController::class, 'toggleCampeonato'])->name('competiciones.campeonato');

    Route::post('/copas',           [CopaController::class, 'store'])->name('copas.store');
    Route::patch('/copas/{copa}',   [CopaController::class, 'update'])->name('copas.update');
    Route::delete('/copas/{copa}',  [CopaController::class, 'destroy'])->name('copas.destroy');

    Route::post('/rocodromos',               [UbicacionController::class, 'store'])->name('rocodromos.store');
    Route::patch('/rocodromos/{ubicacion}',  [UbicacionController::class, 'update'])->name('rocodromos.update');
    Route::delete('/rocodromos/{ubicacion}', [UbicacionController::class, 'destroy'])->name('rocodromos.destroy');
});

Route::middleware(['auth', 'rol:entrenador'])->prefix('entrenador')->name('entrenador.')->group(function () {
    Route::post('/solicitar', [EntrenadorController::class, 'solicitarVinculo'])->name('solicitar');
    Route::delete('/competidor/{competidor}', [EntrenadorController::class, 'eliminarCompetidor'])->name('eliminar_competidor');
    Route::post('/inscribir', [EntrenadorController::class, 'inscribir'])->name('inscribir');
});

// Competiciones — detalle accesible para cualquier usuario autenticado
Route::middleware('auth')->group(function () {
    Route::get('/competiciones/{competicion}', [InscripcionController::class, 'show'])->name('competiciones.show');
    Route::post('/inscripciones/{competicion}/licencia', [InscripcionController::class, 'uploadLicencia'])->name('inscripciones.upload_licencia');
    Route::post('/inscripciones/{competicion}/pago', [InscripcionController::class, 'uploadPago'])->name('inscripciones.upload_pago');
    Route::post('/inscripciones/{competicion}', [InscripcionController::class, 'store'])->name('inscripciones.store');
});

// Árbitro — panel y gestión de inscripciones
Route::middleware(['auth', 'rol:arbitro'])->prefix('arbitro')->name('arbitro.')->group(function () {
    Route::get('/',                  [ArbitroController::class, 'panel'])->name('panel');
    Route::get('/entrenador',        [ArbitroController::class, 'panelEntrenador'])->name('panel.entrenador');
    Route::get('/deportista',        [ArbitroController::class, 'panelDeportista'])->name('panel.deportista');
    Route::get('/competicion/{competicion}', [ArbitroController::class, 'competicion'])->name('competicion');
    Route::get('/competicion/{competicion}/categoria/{categoria}', [ArbitroController::class, 'categoria'])->name('categoria');
    Route::get('/inscripcion/{inscripcion}/documento/{tipo}', [ArbitroController::class, 'verDocumento'])->name('ver_documento');
    Route::patch('/inscripcion/{inscripcion}/validar', [ArbitroController::class, 'validarLicencia'])->name('validar_licencia');
    Route::patch('/inscripcion/{inscripcion}/categoria', [ArbitroController::class, 'cambiarCategoria'])->name('cambiar_categoria');
});

Route::middleware('auth')->prefix('notificaciones')->name('notificaciones.')->group(function () {
    Route::post('/{id}/aceptar', [NotificacionController::class, 'aceptar'])->name('aceptar');
    Route::delete('/{id}/rechazar', [NotificacionController::class, 'rechazar'])->name('rechazar');
    Route::delete('/desvincular', [NotificacionController::class, 'desvincular'])->name('desvincular');
});

require __DIR__.'/auth.php';
