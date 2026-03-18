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
        'arbitro_id',
        'ubicacion_id',
        'name',
        'provincia',
        'fecha_realizacion',
        'fecha_fin',
        'tipo',
        'campeonato',
        'categorias',
    ];

    protected function casts(): array
    {
        return [
            'fecha_realizacion' => 'datetime',
            'fecha_fin'         => 'datetime',
            'campeonato'        => 'boolean',
            'categorias'        => 'array',
        ];
    }

    /** Categorías base disponibles para seleccionar en una competición */
    public static function categoriasDisponibles(): array
    {
        return ['U9', 'U11', 'U13', 'U15', 'U17', 'U19', 'Absoluta', 'Veterana', 'Promoción'];
    }

    public function copa(): BelongsTo
    {
        return $this->belongsTo(Copa::class, 'copa_id');
    }

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    public function arbitro(): BelongsTo
    {
        return $this->belongsTo(User::class, 'arbitro_id');
    }

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'competicions_users', 'competicion_id', 'user_id')
            ->withPivot('tipoDato', 'dato')
            ->withTimestamps();
    }

    public function inscripciones()
    {
        return $this->hasMany(\App\Models\Inscripcion::class);
    }
}
