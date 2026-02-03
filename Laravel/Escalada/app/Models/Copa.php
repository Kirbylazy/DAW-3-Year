<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
