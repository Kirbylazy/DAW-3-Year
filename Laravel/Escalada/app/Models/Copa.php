<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;   // <-- IMPORTANTE
use App\Models\Competicion;

class Copa extends Model
{
    /** @use HasFactory<\Database\Factories\CopaFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'temporada',
        'tipo',
    ];

    protected function casts(): array
    {
        return [
            'temporada' => 'integer',
        ];
    }

    public function competiciones(): HasMany
    {
        return $this->hasMany(Competicion::class, 'copa_id');
    }
}
