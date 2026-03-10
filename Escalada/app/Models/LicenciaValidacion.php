<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicenciaValidacion extends Model
{
    protected $table = 'licencia_validaciones';

    protected $fillable = [
        'user_id',
        'validada_por',
        'competicion_id',
        'tipo',
        'valida_hasta',
    ];

    protected function casts(): array
    {
        return [
            'valida_hasta' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function validador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validada_por');
    }

    public function competicion(): BelongsTo
    {
        return $this->belongsTo(Competicion::class);
    }

    public function estaVigente(): bool
    {
        return $this->valida_hasta->gte(now()->startOfDay());
    }

    /** Comprueba si un usuario tiene licencia anual vigente (tipo='valida') */
    public static function tieneValidezAnual(int $userId): bool
    {
        return self::where('user_id', $userId)
            ->where('tipo', 'valida')
            ->where('valida_hasta', '>=', now()->toDateString())
            ->exists();
    }

    /** Devuelve el registro de validez anual vigente o null */
    public static function validezAnual(int $userId): ?self
    {
        return self::where('user_id', $userId)
            ->where('tipo', 'valida')
            ->where('valida_hasta', '>=', now()->toDateString())
            ->first();
    }
}
