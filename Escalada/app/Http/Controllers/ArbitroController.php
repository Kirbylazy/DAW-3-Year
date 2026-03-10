<?php

namespace App\Http\Controllers;

use App\Models\Competicion;
use App\Models\Inscripcion;
use App\Models\LicenciaValidacion;
use Illuminate\Support\Collection;
use App\Notifications\InscripcionActualizadaNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArbitroController extends Controller
{
    /** Dashboard de la competición: resumen por categorías */
    public function competicion(Competicion $competicion)
    {
        $this->checkArbitro($competicion);

        $inscripciones = Inscripcion::where('competicion_id', $competicion->id)
            ->whereIn('estado', ['pendiente', 'aprobada', 'rechazada'])
            ->with('user')
            ->get();

        $categorias = $inscripciones
            ->groupBy('categoria')
            ->map(fn($grupo) => [
                'total'     => $grupo->count(),
                'pendiente' => $grupo->where('estado', 'pendiente')->count(),
                'aprobada'  => $grupo->where('estado', 'aprobada')->count(),
                'rechazada' => $grupo->where('estado', 'rechazada')->count(),
            ])
            ->sortKeys();

        $totales = [
            'total'     => $inscripciones->count(),
            'pendiente' => $inscripciones->where('estado', 'pendiente')->count(),
            'aprobada'  => $inscripciones->where('estado', 'aprobada')->count(),
            'rechazada' => $inscripciones->where('estado', 'rechazada')->count(),
        ];

        return view('arbitro.competicion', compact('competicion', 'categorias', 'totales'));
    }

    /** Lista de competidores de una categoría */
    public function categoria(Competicion $competicion, string $categoria)
    {
        $this->checkArbitro($competicion);

        $inscripciones = Inscripcion::where('competicion_id', $competicion->id)
            ->where('categoria', $categoria)
            ->whereIn('estado', ['pendiente', 'aprobada', 'rechazada'])
            ->with('user')
            ->orderBy('created_at')
            ->get();

        // Licencias anuales vigentes para los competidores de esta categoría
        $licenciasAnuales = LicenciaValidacion::whereIn('user_id', $inscripciones->pluck('user_id'))
            ->where('tipo', 'valida')
            ->where('valida_hasta', '>=', now()->toDateString())
            ->get()
            ->keyBy('user_id');

        return view('arbitro.categoria', compact('competicion', 'categoria', 'inscripciones', 'licenciasAnuales'));
    }

    /** Servir documento (licencia o pago) */
    public function verDocumento(Inscripcion $inscripcion, string $tipo)
    {
        $this->checkArbitroPorCompeticion($inscripcion->competicion_id);

        $path = match ($tipo) {
            'licencia' => $inscripcion->licencia_path,
            'pago'     => $inscripcion->pago_path,
            default    => abort(404),
        };

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'Documento no encontrado.');
        }

        return Storage::disk('public')->response($path);
    }

    /** Verificar un documento (licencia o pago) y recalcular estado global */
    public function validarLicencia(Request $request, Inscripcion $inscripcion)
    {
        $this->checkArbitroPorCompeticion($inscripcion->competicion_id);

        $request->validate([
            'tipo'     => 'required|in:licencia,pago',
            'decision' => 'required|in:valida,valida_dia,no_valida',
            'motivo'   => 'required_if:decision,no_valida|nullable|string|max:500',
        ]);

        $arbitro     = auth()->user();
        $competidor  = $inscripcion->user;
        $competicion = $inscripcion->competicion;
        $tipo        = $request->tipo;

        if ($tipo === 'licencia') {
            $inscripcion->licencia_estado = $request->decision;
            $inscripcion->licencia_motivo = $request->decision === 'no_valida' ? $request->motivo : null;

            // Registrar validez de licencia para el año si aplica
            if ($request->decision !== 'no_valida') {
                $validaHasta = $request->decision === 'valida'
                    ? now()->endOfYear()->toDateString()
                    : $competicion->fecha_realizacion->toDateString();

                LicenciaValidacion::updateOrCreate(
                    ['user_id' => $competidor->id, 'competicion_id' => $competicion->id],
                    [
                        'validada_por' => $arbitro->id,
                        'tipo'         => $request->decision,
                        'valida_hasta' => $validaHasta,
                    ]
                );
            }
        } else {
            $inscripcion->pago_estado = $request->decision;
            $inscripcion->pago_motivo = $request->decision === 'no_valida' ? $request->motivo : null;
        }

        $estadoAnterior = $inscripcion->estado;
        $inscripcion->recalcularEstado();

        // Notificar solo si el estado global cambia a aprobada o rechazada
        if ($inscripcion->estado !== $estadoAnterior &&
            in_array($inscripcion->estado, ['aprobada', 'rechazada'])) {

            $motivo = $inscripcion->estado === 'rechazada'
                ? ($inscripcion->licencia_estado === 'no_valida'
                    ? 'Licencia: ' . $inscripcion->licencia_motivo
                    : 'Justificante de pago: ' . $inscripcion->pago_motivo)
                : null;

            $competidor->notify(new InscripcionActualizadaNotification($inscripcion, $motivo));
        }

        $etiqueta = $tipo === 'licencia' ? 'Licencia' : 'Justificante de pago';

        if ($request->expectsJson()) {
            return response()->json([
                'success'         => true,
                'message'         => "$etiqueta verificado correctamente.",
                'estado'          => $inscripcion->estado,
                'licencia_estado' => $inscripcion->licencia_estado,
                'pago_estado'     => $inscripcion->pago_estado,
            ]);
        }

        return back()->with('success', "$etiqueta verificado correctamente.");
    }

    /** Cambiar categoría de un competidor manualmente */
    public function cambiarCategoria(Request $request, Inscripcion $inscripcion)
    {
        $this->checkArbitroPorCompeticion($inscripcion->competicion_id);

        $request->validate([
            'categoria' => ['required', 'string', \Illuminate\Validation\Rule::in(\App\Models\Inscripcion::listaCategorias())],
        ]);

        $inscripcion->update(['categoria' => $request->categoria]);

        return back()->with('success', "Categoría cambiada a «{$request->categoria}».");
    }

    private function checkArbitro(Competicion $competicion): void
    {
        if ($competicion->arbitro_id !== auth()->id()) {
            abort(403, 'No eres el árbitro asignado a esta competición.');
        }
    }

    private function checkArbitroPorCompeticion(int $competicionId): void
    {
        $this->checkArbitro(Competicion::findOrFail($competicionId));
    }
}
