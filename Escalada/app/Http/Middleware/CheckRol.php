<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRol
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $niveles = ['competidor' => 1, 'entrenador' => 2, 'arbitro' => 3, 'admin' => 4];

        $userNivel   = $niveles[$request->user()?->rol] ?? 0;
        $minRequerido = collect($roles)->map(fn($r) => $niveles[$r] ?? 0)->min();

        if (!$request->user() || $userNivel < $minRequerido) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para acceder a esa sección.');
        }

        return $next($request);
    }
}
