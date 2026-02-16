<?php

namespace App\Http\Controllers;

use App\Models\Copa;

class CopaController extends Controller
{

public function index()
{
    $copas = Copa::orderBy('temporada', 'desc')->get();

    return view('copas.index', compact('copas'));
}

public function show(Copa $copa)
{
    return view('copas.show', compact('copa'));
}

}
