<?php

namespace App\Http\Controllers;

use App\Models\Competicion;
use App\Models\Copa;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function pruebas(Request $request)
    {
        $filtro  = $request->get('filtro', 'proximas');
        $copaId  = $request->get('copa_id', '');

        $query = Competicion::with('arbitro', 'copa', 'ubicacion')
            ->orderBy('fecha_realizacion');

        match ($filtro) {
            'proximas' => $query->where('fecha_realizacion', '>=', now()),
            'este_año' => $query->whereYear('fecha_realizacion', now()->year),
            default    => null,
        };

        if ($copaId === 'sin_copa') {
            $query->whereNull('copa_id');
        } elseif ($copaId) {
            $query->where('copa_id', $copaId);
        }

        $competiciones = $query->get();
        $copas         = Copa::orderBy('temporada', 'desc')->orderBy('name')->get();
        $ubicaciones   = Ubicacion::orderBy('name')->get();
        $arbitros      = User::whereIn('rol', ['arbitro', 'admin'])->orderBy('name')->get();

        return view('admin.pruebas', compact('competiciones', 'copas', 'ubicaciones', 'arbitros', 'filtro', 'copaId'));
    }

    public function copas(Request $request)
    {
        $filtro = $request->get('filtro', 'todas');

        $query = Copa::withCount('competiciones')
            ->orderBy('temporada', 'desc')
            ->orderBy('name');

        if ($filtro === 'este_año') {
            $query->where('temporada', now()->year);
        }

        $copas = $query->get();

        return view('admin.copas', compact('copas', 'filtro'));
    }

    public function usuarios(Request $request)
    {
        $rolFiltro = $request->get('rol', 'todos');
        $buscar    = $request->get('buscar', '');

        $query = User::where('id', '!=', auth()->id())->orderBy('name');

        if ($rolFiltro !== 'todos') {
            $query->where('rol', $rolFiltro);
        }

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('name', 'like', "%{$buscar}%")
                  ->orWhere('dni', 'like', "%{$buscar}%");
            });
        }

        $usuarios = $query->get();

        return view('admin.usuarios', compact('usuarios', 'rolFiltro', 'buscar'));
    }

    public function rocodromos()
    {
        $ubicaciones = Ubicacion::withCount('competiciones')->orderBy('name')->get();
        return view('admin.rocodromos', compact('ubicaciones'));
    }

    public function actualizarUsuario(Request $request, User $user)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'dni'              => ['nullable', 'string', 'max:20', Rule::unique(User::class)->ignore($user->id)],
            'fecha_nacimiento' => 'nullable|date',
            'provincia'        => 'nullable|string|max:100',
            'talla'            => 'nullable|in:XS,S,M,L,XL,XXL',
            'genero'           => 'nullable|in:M,F,otro',
            'rol'              => 'required|in:competidor,entrenador,arbitro,admin',
        ]);

        $user->update($request->only([
            'name', 'email', 'dni', 'fecha_nacimiento', 'provincia', 'talla', 'genero', 'rol',
        ]));

        return back()->with('status', "Usuario «{$user->name}» actualizado correctamente.");
    }

    public function destroyUsuario(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta desde aquí.');
        }

        $nombre = $user->name;
        $user->delete();

        return back()->with('status', "Usuario «{$nombre}» eliminado.");
    }

    public function updateRol(Request $request, User $user)
    {
        $request->validate(['rol' => ['required', 'in:competidor,arbitro,entrenador']]);
        $user->update(['rol' => $request->rol]);
        return back()->with('status', "Rol de {$user->name} actualizado a {$request->rol}.");
    }

    public function asignarArbitro(Request $request, Competicion $competicion)
    {
        $request->validate(['arbitro_id' => 'nullable|exists:users,id']);

        if ($request->arbitro_id) {
            $arbitro = User::findOrFail($request->arbitro_id);
            if (!$arbitro->isArbitro()) {
                return back()->with('error', "'{$arbitro->name}' no tiene rol de árbitro o superior.");
            }
        }

        $competicion->update(['arbitro_id' => $request->arbitro_id ?: null]);
        return back()->with('status', "Árbitro de '{$competicion->name}' actualizado.");
    }
}
