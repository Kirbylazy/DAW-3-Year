<?php

namespace App\Http\Controllers;

use App\Models\Competicion;
use App\Models\User;
use App\Notifications\SolicitudEntrenadorNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntrenadorController extends Controller
{
    public function solicitarVinculo(Request $request)
    {
        $request->validate(['competidor_id' => 'required|exists:users,id']);

        $entrenador  = auth()->user();
        $competidor  = User::findOrFail($request->competidor_id);

        if ($competidor->rol !== 'competidor') {
            return back()->with('error', 'El usuario seleccionado no es un competidor.');
        }

        if ($competidor->id === $entrenador->id) {
            return back()->with('error', 'No puedes enviarte una solicitud a ti mismo.');
        }

        // El competidor ya tiene entrenador (aceptado o pendiente)
        $yaVinculado = DB::table('entrenador_competidor')
            ->where('competidor_id', $competidor->id)
            ->exists();

        if ($yaVinculado) {
            return back()->with('error', 'Este competidor ya tiene un entrenador o una solicitud pendiente.');
        }

        DB::table('entrenador_competidor')->insert([
            'entrenador_id'  => $entrenador->id,
            'competidor_id'  => $competidor->id,
            'estado'         => 'pending',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        $competidor->notify(new SolicitudEntrenadorNotification($entrenador));

        return back()->with('status', "Solicitud enviada a {$competidor->name}.");
    }

    public function eliminarCompetidor(User $competidor)
    {
        $entrenador = auth()->user();

        DB::table('entrenador_competidor')
            ->where('entrenador_id', $entrenador->id)
            ->where('competidor_id', $competidor->id)
            ->delete();

        return back()->with('status', "{$competidor->name} ha sido eliminado de tu equipo.");
    }

    public function inscribir(Request $request)
    {
        $request->validate([
            'competicion_id' => 'required|exists:competicions,id',
            'participantes'  => 'required|array|min:1',
            'participantes.*'=> 'exists:users,id',
        ]);

        $entrenador  = auth()->user();
        $competicion = Competicion::findOrFail($request->competicion_id);

        if ($competicion->fecha_realizacion < now()) {
            return back()->with('error', 'Esta competición ya ha tenido lugar.');
        }

        // IDs permitidos: competidores aceptados + el propio entrenador
        $permitidos = $entrenador->competidoresAceptados()
            ->pluck('users.id')
            ->push($entrenador->id)
            ->toArray();

        $inscritos = 0;
        foreach ($request->participantes as $userId) {
            if (!in_array((int) $userId, $permitidos)) {
                continue;
            }

            $yaInscrito = DB::table('competicions_users')
                ->where('user_id', $userId)
                ->where('competicion_id', $competicion->id)
                ->exists();

            if (!$yaInscrito) {
                DB::table('competicions_users')->insert([
                    'user_id'       => $userId,
                    'competicion_id'=> $competicion->id,
                    'tipoDato'      => null,
                    'dato'          => null,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
                $inscritos++;
            }
        }

        return back()->with('status', "{$inscritos} inscripción(es) realizadas correctamente.");
    }
}
