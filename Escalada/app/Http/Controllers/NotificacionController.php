<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class NotificacionController extends Controller
{
    public function aceptar(string $id)
    {
        $user         = auth()->user();
        $notification = $user->notifications()->findOrFail($id);
        $data         = $notification->data;

        DB::table('entrenador_competidor')
            ->where('entrenador_id', $data['entrenador_id'])
            ->where('competidor_id', $user->id)
            ->update(['estado' => 'accepted', 'updated_at' => now()]);

        $notification->markAsRead();

        return back()->with('status', "Has aceptado a {$data['entrenador_name']} como tu entrenador.");
    }

    public function rechazar(string $id)
    {
        $user         = auth()->user();
        $notification = $user->notifications()->findOrFail($id);
        $data         = $notification->data;

        DB::table('entrenador_competidor')
            ->where('entrenador_id', $data['entrenador_id'])
            ->where('competidor_id', $user->id)
            ->delete();

        $notification->delete();

        return back()->with('status', 'Has rechazado la solicitud de entrenador.');
    }

    public function desvincular()
    {
        $user = auth()->user();

        DB::table('entrenador_competidor')
            ->where('competidor_id', $user->id)
            ->where('estado', 'accepted')
            ->delete();

        return back()->with('status', 'Te has desvinculado de tu entrenador.');
    }
}
