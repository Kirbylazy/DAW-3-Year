<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Competicion extends Model
{
    /** @use HasFactory<\Database\Factories\CompeticionFactory> */
    use HasFactory;

    protected $table = 'competicions';

    protected $fillable = [
        'copa_id',
        'ubicacion_id',
        'name',
        'provincia',
        'fecha_realizacion',
        'tipo',
        'campeonato',
    ];

    protected function casts(): array
    {
        return [
            'fecha_realizacion' => 'datetime',
            'campeonato' => 'boolean',
        ];
    }

    public function copa(): BelongsTo
    {
        return $this->belongsTo(Copa::class, 'copa_id');
    }

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'competicions_users','competicion_id','user_id')
        
        ->string('tipoDato')
        ->string('dato')
        ->withTimestamps();
    }
}
