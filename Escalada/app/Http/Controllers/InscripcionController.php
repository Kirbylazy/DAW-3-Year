<?php

namespace App\Http\Controllers;

use App\Models\Competicion;
use App\Models\Inscripcion;
use App\Models\LicenciaValidacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InscripcionController extends Controller
{
    /** Detalle de una competición con formulario de inscripción */
    public function show(Competicion $competicion)
    {
        $user = auth()->user();

        $inscripcion = Inscripcion::where('user_id', $user->id)
            ->where('competicion_id', $competicion->id)
            ->first();

        // Licencia anual vigente (verificada en una competición anterior este año)
        $licenciaAnual = $user->rol === 'competidor'
            ? LicenciaValidacion::validezAnual($user->id)
            : null;

        // Marcar como leídas las notificaciones de esta competición
        $notifInscripcion = null;
        if ($user->rol === 'competidor') {
            $notifInscripcion = $user->unreadNotifications
                ->where('data.tipo', 'inscripcion_actualizada')
                ->where('data.competicion_id', $competicion->id)
                ->first();

            if ($notifInscripcion) {
                $notifInscripcion->markAsRead();
            }
        }

        return view('competidor.competicion-show', compact(
            'competicion', 'inscripcion', 'notifInscripcion', 'licenciaAnual'
        ));
    }

    /** Subir licencia federativa */
    public function uploadLicencia(Request $request, Competicion $competicion)
    {
        $this->soloCompetidor();

        $request->validate([
            'licencia' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $user = auth()->user();
        $inscripcion = Inscripcion::firstOrCreate(
            ['user_id' => $user->id, 'competicion_id' => $competicion->id],
            ['categoria' => Inscripcion::calcularCategoria($user)]
        );

        if ($inscripcion->licencia_path) {
            Storage::disk('public')->delete($inscripcion->licencia_path);
        }

        $path = $request->file('licencia')->store(
            "inscripciones/{$competicion->id}/{$user->id}",
            'public'
        );

        $inscripcion->update(['licencia_path' => $path]);

        return back()->with('success', 'Licencia subida correctamente.');
    }

    /** Subir justificante de pago */
    public function uploadPago(Request $request, Competicion $competicion)
    {
        $this->soloCompetidor();

        $request->validate([
            'pago' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $user = auth()->user();
        $inscripcion = Inscripcion::firstOrCreate(
            ['user_id' => $user->id, 'competicion_id' => $competicion->id],
            ['categoria' => Inscripcion::calcularCategoria($user)]
        );

        if ($inscripcion->pago_path) {
            Storage::disk('public')->delete($inscripcion->pago_path);
        }

        $path = $request->file('pago')->store(
            "inscripciones/{$competicion->id}/{$user->id}",
            'public'
        );

        $inscripcion->update(['pago_path' => $path]);

        return back()->with('success', 'Justificante de pago subido correctamente.');
    }

    /** Enviar inscripción (pasar a estado pendiente) */
    public function store(Request $request, Competicion $competicion)
    {
        $this->soloCompetidor();

        if ($competicion->fecha_realizacion->isPast()) {
            return back()->with('error', 'No puedes inscribirte en una competición que ya ha pasado.');
        }

        $user          = auth()->user();
        $licenciaAnual = LicenciaValidacion::validezAnual($user->id);

        $inscripcion = Inscripcion::where('user_id', $user->id)
            ->where('competicion_id', $competicion->id)
            ->first();

        // Con licencia anual solo hace falta el justificante de pago
        $licenciaOk = $licenciaAnual || ($inscripcion && $inscripcion->licencia_path);
        $pagoOk     = $inscripcion && $inscripcion->pago_path;

        if (!$licenciaOk || !$pagoOk) {
            $msg = !$pagoOk
                ? 'Debes subir el justificante de pago antes de inscribirte.'
                : 'Debes subir la licencia federativa antes de inscribirte.';
            return back()->with('error', $msg);
        }

        if ($inscripcion->estado === 'pendiente') {
            return back()->with('error', 'Tu inscripción ya está pendiente de revisión por el árbitro.');
        }

        if ($inscripcion->estado === 'aprobada') {
            return back()->with('error', 'Tu inscripción ya ha sido aprobada.');
        }

        $updateData = [
            'estado'         => 'pendiente',
            'motivo_rechazo' => null,
            'categoria'      => Inscripcion::calcularCategoria($user),
        ];

        // Si tiene licencia anual válida, marcarla automáticamente como verificada
        if ($licenciaAnual) {
            $updateData['licencia_estado'] = 'valida';
            $updateData['licencia_motivo'] = null;
        }

        $inscripcion->update($updateData);

        return back()->with('success', 'Inscripción enviada. El árbitro revisará tu documentación en breve.');
    }

    private function soloCompetidor(): void
    {
        if (auth()->user()->rol !== 'competidor') {
            abort(403, 'Solo los competidores pueden usar este formulario.');
        }
    }
}
