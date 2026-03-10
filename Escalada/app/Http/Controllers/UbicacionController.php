<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:150',
            'provincia' => 'required|string',
            'direccion' => 'nullable|string|max:255',
            'alto'      => 'nullable|numeric|min:0',
            'ancho'     => 'nullable|numeric|min:0',
            'n_lineas'  => 'nullable|integer|min:0',
        ]);

        $ubicacion = Ubicacion::create($request->only(['name', 'provincia', 'direccion', 'alto', 'ancho', 'n_lineas']));

        return back()->with('status', "Rocódromo «{$ubicacion->name}» creado correctamente.");
    }

    public function update(Request $request, Ubicacion $ubicacion)
    {
        $request->validate([
            'name'      => 'required|string|max:150',
            'provincia' => 'required|string',
            'direccion' => 'nullable|string|max:255',
            'alto'      => 'nullable|numeric|min:0',
            'ancho'     => 'nullable|numeric|min:0',
            'n_lineas'  => 'nullable|integer|min:0',
        ]);

        $ubicacion->update($request->only(['name', 'provincia', 'direccion', 'alto', 'ancho', 'n_lineas']));

        return back()->with('status', "Rocódromo «{$ubicacion->name}» actualizado.");
    }

    public function destroy(Ubicacion $ubicacion)
    {
        if ($ubicacion->competiciones()->exists()) {
            return back()->with('error',
                "No se puede eliminar «{$ubicacion->name}» porque tiene competiciones asociadas."
            );
        }

        $nombre = $ubicacion->name;
        $ubicacion->delete();

        return back()->with('status', "Rocódromo «{$nombre}» eliminado.");
    }
}
