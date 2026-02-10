<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacion extends Model
{
    /** @use HasFactory<\Database\Factories\UbicacionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'provincia',
        'direccion',
        'alto',
        'ancho',
        'n_lineas',
    ];

    protected function casts(): array
    {
        return [
            'n_lineas' => 'integer',
            'alto' => 'float',
            'ancho' => 'float',
        ];
    }

    public function competiciones(): HasMany
    {
        return $this->hasMany(Competicion::class, 'ubicacion_id');
    }
}
