<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'user_id',
        'competicion_id',
        'licencia_path',
        'pago_path',
        'estado',
        'motivo_rechazo',
        'categoria',
        'licencia_estado',
        'pago_estado',
        'licencia_motivo',
        'pago_motivo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function competicion(): BelongsTo
    {
        return $this->belongsTo(Competicion::class);
    }

    public function documentosCompletos(): bool
    {
        return !empty($this->licencia_path) && !empty($this->pago_path);
    }

    /** Recalcula el estado global según los estados de cada documento */
    public function recalcularEstado(): void
    {
        if ($this->licencia_estado === 'no_valida' || $this->pago_estado === 'no_valida') {
            $this->estado = 'rechazada';
        } elseif (
            in_array($this->licencia_estado, ['valida', 'valida_dia']) &&
            in_array($this->pago_estado, ['valida', 'valida_dia'])
        ) {
            $this->estado = 'aprobada';
        } else {
            $this->estado = 'pendiente';
        }
        $this->save();
    }

    public static function etiquetaEstadoDoc(?string $estado): string
    {
        return match ($estado) {
            'valida'     => 'Válida',
            'valida_dia' => 'Válida por un día',
            'no_valida'  => 'No válida',
            default      => 'Pendiente',
        };
    }

    /**
     * Calcula la categoría por defecto según el año de nacimiento.
     * Solo se usa el año (mes y día son irrelevantes).
     * Reglas: U9 (7-8), U11 (9-10), U13 (11-12), U15 (13-14),
     *         U17 (15-16), U19 (17-18), Absoluta (19-34), Veterana (35+).
     * Promoción nunca se asigna automáticamente.
     */
    public static function calcularCategoria(User $user): string
    {
        $añoNac = (int) ($user->fecha_nacimiento?->format('Y') ?? now()->year);
        $edad   = now()->year - $añoNac;

        $cat = match (true) {
            $edad <= 8  => 'U9',
            $edad <= 10 => 'U11',
            $edad <= 12 => 'U13',
            $edad <= 14 => 'U15',
            $edad <= 16 => 'U17',
            $edad <= 18 => 'U19',
            $edad <= 34 => 'Absoluta',
            default     => 'Veterana',
        };

        $genero = match ($user->genero) {
            'M'     => 'Masculino',
            'F'     => 'Femenino',
            default => 'Masculino',
        };

        return "$genero $cat";
    }

    /** Lista completa de categorías válidas para selección manual */
    public static function listaCategorias(): array
    {
        $result = [];
        foreach (['U9', 'U11', 'U13', 'U15', 'U17', 'U19', 'Absoluta', 'Veterana'] as $cat) {
            $result[] = "Masculino $cat";
            $result[] = "Femenino $cat";
        }
        $result[] = 'Masculino Promoción';
        $result[] = 'Femenino Promoción';
        $result[] = 'Mixta Promoción';
        return $result;
    }
}
