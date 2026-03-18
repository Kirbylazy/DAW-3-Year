<?php

namespace App\Http\Controllers;

use App\Models\Competicion;
use Illuminate\Http\Request;

class CompeticionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:150',
            'tipo'              => 'required|in:bloque,dificultad,velocidad',
            'fecha_realizacion' => 'required|date',
            'fecha_fin'         => 'nullable|date|after_or_equal:fecha_realizacion',
            'provincia'         => 'required|string',
            'ubicacion_id'      => 'required|exists:ubicacions,id',
            'copa_id'           => 'nullable|exists:copas,id',
            'arbitro_id'        => 'nullable|exists:users,id',
            'categorias'        => 'nullable|array',
            'categorias.*'      => 'in:U9,U11,U13,U15,U17,U19,Absoluta,Veterana,Promoción',
        ]);

        Competicion::create([
            'name'              => $request->name,
            'tipo'              => $request->tipo,
            'fecha_realizacion' => $request->fecha_realizacion,
            'fecha_fin'         => $request->fecha_fin ?: null,
            'provincia'         => $request->provincia,
            'ubicacion_id'      => $request->ubicacion_id,
            'copa_id'           => $request->copa_id ?: null,
            'arbitro_id'        => $request->arbitro_id ?: null,
            'campeonato'        => false,
            'categorias'        => $request->categorias ?? [],
        ]);

        return back()->with('status', "Prueba «{$request->name}» creada correctamente.");
    }

    public function update(Request $request, Competicion $competicion)
    {
        $request->validate([
            'name'              => 'required|string|max:150',
            'tipo'              => 'required|in:bloque,dificultad,velocidad',
            'fecha_realizacion' => 'required|date',
            'fecha_fin'         => 'nullable|date|after_or_equal:fecha_realizacion',
            'provincia'         => 'required|string',
            'ubicacion_id'      => 'required|exists:ubicacions,id',
            'copa_id'           => 'nullable|exists:copas,id',
            'arbitro_id'        => 'nullable|exists:users,id',
            'categorias'        => 'nullable|array',
            'categorias.*'      => 'in:U9,U11,U13,U15,U17,U19,Absoluta,Veterana,Promoción',
        ]);

        $competicion->update([
            'name'              => $request->name,
            'tipo'              => $request->tipo,
            'fecha_realizacion' => $request->fecha_realizacion,
            'fecha_fin'         => $request->fecha_fin ?: null,
            'provincia'         => $request->provincia,
            'ubicacion_id'      => $request->ubicacion_id,
            'copa_id'           => $request->copa_id ?: null,
            'arbitro_id'        => $request->arbitro_id ?: null,
            'categorias'        => $request->categorias ?? [],
        ]);

        return back()->with('status', "Prueba «{$competicion->name}» actualizada.");
    }

    public function toggleCampeonato(Competicion $competicion)
    {
        if ($competicion->campeonato) {
            $competicion->update(['campeonato' => false]);
            return back()->with('status', "«{$competicion->name}» ya no es campeonato.");
        }

        $año = $competicion->fecha_realizacion->year;
        $existente = Competicion::where('tipo', $competicion->tipo)
            ->where('campeonato', true)
            ->whereYear('fecha_realizacion', $año)
            ->where('id', '!=', $competicion->id)
            ->first();

        if ($existente) {
            return back()->with('error',
                "Ya hay un campeonato de {$competicion->tipo} en {$año}: «{$existente->name}»."
            );
        }

        $competicion->update(['campeonato' => true]);
        return back()->with('status', "«{$competicion->name}» designada campeonato de {$competicion->tipo} {$año}.");
    }

    public function destroy(Competicion $competicion)
    {
        $nombre = $competicion->name;
        $competicion->delete(); // inscripciones en cascade

        return back()->with('status', "Prueba «{$nombre}» eliminada.");
    }
}
