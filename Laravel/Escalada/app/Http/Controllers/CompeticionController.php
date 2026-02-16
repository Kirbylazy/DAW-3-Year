<?php

namespace App\Http\Controllers;

use App\Models\Competicion;

class CompeticionController extends Controller
{
    public function index()
    {
        $competiciones = Competicion::with(['copa', 'ubicacion'])
            ->orderBy('fecha_realizacion')
            ->paginate(12);

        return view('competicions.index', compact('competiciones'));
    }

    public function show(Competicion $competicion)
    {
        $competicion->load(['copa', 'ubicacion']);

        return view('competicions.show', compact('competicion'));
    }
}
