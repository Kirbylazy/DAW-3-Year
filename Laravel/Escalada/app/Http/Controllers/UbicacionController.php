<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacion::orderBy('name')->get();

        return view('ubicacions.index', compact('ubicaciones'));
    }

    public function show(Ubicacion $ubicacion)
    {
        return view('ubicacions.show', compact('ubicacion'));
    }
}
