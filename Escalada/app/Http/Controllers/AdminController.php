<?php

namespace App\Http\Controllers;

use App\Models\Competicion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::where('id', '!=', auth()->id())
            ->orderBy('name')
            ->get();

        $competiciones = Competicion::with('arbitro', 'copa')
            ->orderBy('fecha_realizacion')
            ->get();

        $arbitros = User::whereIn('rol', ['arbitro', 'admin'])
            ->orderBy('name')
            ->get();

        return view('dashboard.admin', compact('usuarios', 'competiciones', 'arbitros'));
    }

    public function updateRol(Request $request, User $user)
    {
        $request->validate([
            'rol' => ['required', 'in:competidor,arbitro,entrenador'],
        ]);

        $user->update(['rol' => $request->rol]);

        return back()->with('status', "Rol de {$user->name} actualizado a {$request->rol}.");
    }

    public function asignarArbitro(Request $request, Competicion $competicion)
    {
        $request->validate([
            'arbitro_id' => 'nullable|exists:users,id',
        ]);

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
