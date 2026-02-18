<?php

namespace App\Http\Controllers;

use App\Models\Competicion;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::where('id', '!=', auth()->id())
            ->orderBy('name')
            ->paginate(20);

        $competiciones = Competicion::query()
            ->where('fecha_realizacion', '>=', now())
            ->orderBy('fecha_realizacion')
            ->paginate(10);

        return view('dashboard.admin', compact('usuarios', 'competiciones'));
    }

    public function updateRol(Request $request, User $user)
    {
        $request->validate([
            'rol' => ['required', 'in:competidor,arbitro'],
        ]);

        $user->update(['rol' => $request->rol]);

        return back()->with('status', "Rol de {$user->name} actualizado a {$request->rol}.");
    }
}
