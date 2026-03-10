<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competicion;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class InscripcionesSeeder extends Seeder
{
    public function run(): void
    {
        // Crear imagen placeholder para los documentos de prueba
        $placeholderDir = storage_path('app/public/inscripciones');
        if (!is_dir($placeholderDir)) {
            mkdir($placeholderDir, 0755, true);
        }

        $placeholderPath = $placeholderDir . '/placeholder.jpg';
        if (!file_exists($placeholderPath)) {
            // GIF 1x1 pixel transparente (mínimo válido)
            file_put_contents(
                $placeholderPath,
                base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7')
            );
        }

        $licenciaPlaceholder = 'inscripciones/placeholder.jpg';
        $pagoPlaceholder     = 'inscripciones/placeholder.jpg';

        // Asignar árbitro de prueba a la primera competición si no tiene árbitro
        $arbitro = User::where('email', 'arbitro@escalada.com')->first();
        if ($arbitro) {
            Competicion::whereNull('arbitro_id')->each(function ($c) use ($arbitro) {
                $c->update(['arbitro_id' => $arbitro->id]);
            });
        }

        $competiciones = Competicion::all();
        $competidores  = User::where('rol', 'competidor')->pluck('id')->shuffle();

        if ($competidores->count() < 150) {
            $this->command->warn('Hay menos de 150 competidores. Se usarán todos los disponibles.');
        }

        foreach ($competiciones as $competicion) {
            $seleccionados = $competidores->take(150);

            foreach ($seleccionados as $userId) {
                $user = User::find($userId);
                if (!$user) continue;

                if (Inscripcion::where('user_id', $userId)->where('competicion_id', $competicion->id)->exists()) {
                    continue;
                }

                // Distribución de estados realista
                $rand = rand(1, 10);
                if ($rand <= 3) {
                    // Pendiente (30%) — ningún doc verificado aún
                    $estado = 'pendiente';
                    $licenciaEstado = null;
                    $pagoEstado     = null;
                    $licenciaMotivo = null;
                    $pagoMotivo     = null;
                } elseif ($rand <= 6) {
                    // Aprobada (30%) — ambos docs válidos
                    $estado = 'aprobada';
                    $licenciaEstado = rand(0,1) ? 'valida' : 'valida_dia';
                    $pagoEstado     = rand(0,1) ? 'valida' : 'valida_dia';
                    $licenciaMotivo = null;
                    $pagoMotivo     = null;
                } elseif ($rand <= 8) {
                    // Rechazada por licencia (20%)
                    $estado = 'rechazada';
                    $licenciaEstado = 'no_valida';
                    $pagoEstado     = rand(0,1) ? 'valida' : null;
                    $licenciaMotivo = 'La licencia federativa está caducada o no corresponde al titular.';
                    $pagoMotivo     = null;
                } elseif ($rand === 9) {
                    // Rechazada por pago (10%)
                    $estado = 'rechazada';
                    $licenciaEstado = rand(0,1) ? 'valida' : null;
                    $pagoEstado     = 'no_valida';
                    $licenciaMotivo = null;
                    $pagoMotivo     = 'El justificante de pago no es válido o el importe no corresponde.';
                } else {
                    // Pendiente con licencia ya verificada pero pago no (10%)
                    $estado = 'pendiente';
                    $licenciaEstado = 'valida';
                    $pagoEstado     = null;
                    $licenciaMotivo = null;
                    $pagoMotivo     = null;
                }

                Inscripcion::create([
                    'user_id'         => $userId,
                    'competicion_id'  => $competicion->id,
                    'licencia_path'   => $licenciaPlaceholder,
                    'pago_path'       => $pagoPlaceholder,
                    'estado'          => $estado,
                    'motivo_rechazo'  => null,
                    'categoria'       => Inscripcion::calcularCategoria($user),
                    'licencia_estado' => $licenciaEstado,
                    'pago_estado'     => $pagoEstado,
                    'licencia_motivo' => $licenciaMotivo,
                    'pago_motivo'     => $pagoMotivo,
                    'created_at'      => now()->subDays(rand(1, 30)),
                    'updated_at'      => now()->subDays(rand(0, 5)),
                ]);
            }
        }

        $this->command->info('Inscripciones de prueba creadas correctamente.');
    }
}
