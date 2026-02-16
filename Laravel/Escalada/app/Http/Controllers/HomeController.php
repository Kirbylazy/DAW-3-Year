<?php

namespace App\Http\Controllers;

use App\Models\Competicion;
use App\Models\Copa;
use App\Models\Ubicacion;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'stats' => [
                'copas' => Copa::count(),
                'competiciones' => Competicion::count(),
                'ubicaciones' => Ubicacion::count(),
            ],
            'proximas' => Competicion::orderBy('fecha_realizacion')->take(6)->get(),
        ]);
    }
}

