<?php

namespace App\Http\Controllers;

use App\Models\Copa;
use Illuminate\Http\Request;


class CopaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tipo'      => 'required|in:bloque,dificultad,velocidad',
            'temporada' => 'required|integer|min:2000|max:2100',
            'name'      => 'required|string|max:150',
        ]);

        Copa::create([
            'name'      => $request->name,
            'tipo'      => $request->tipo,
            'temporada' => (int) $request->temporada,
        ]);

        return back()->with('status', "Copa «{$request->name}» creada correctamente.");
    }

    public function update(Request $request, Copa $copa)
    {
        $request->validate([
            'tipo'      => 'required|in:bloque,dificultad,velocidad',
            'temporada' => 'required|integer|min:2000|max:2100',
            'name'      => 'required|string|max:150',
        ]);

        $copa->update([
            'name'      => $request->name,
            'tipo'      => $request->tipo,
            'temporada' => (int) $request->temporada,
        ]);

        return back()->with('status', "Copa «{$copa->name}» actualizada.");
    }

    public function destroy(Copa $copa)
    {
        if ($copa->competiciones()->exists()) {
            return back()->with('error',
                "No se puede eliminar «{$copa->name}» porque tiene pruebas asociadas. Desasócialas primero."
            );
        }

        $nombre = $copa->name;
        $copa->delete();

        return back()->with('status', "Copa «{$nombre}» eliminada.");
    }
}
