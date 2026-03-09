<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dni',
        'fecha_nacimiento',
        'provincia',
        'talla',
        'genero',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'fecha_nacimiento' => 'datetime',
        ];
    }

    public function competiciones(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Competicion::class, 'competicions_users', 'user_id', 'competicion_id')
            ->withPivot('tipoDato', 'dato')
            ->withTimestamps();
    }

    /** Competidores aceptados por este entrenador */
    public function competidoresAceptados(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'entrenador_competidor', 'entrenador_id', 'competidor_id')
            ->wherePivot('estado', 'accepted')
            ->withPivot('estado', 'created_at');
    }

    /** Solicitudes enviadas por este entrenador aún sin respuesta */
    public function competidoresPendientes(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'entrenador_competidor', 'entrenador_id', 'competidor_id')
            ->wherePivot('estado', 'pending')
            ->withPivot('estado', 'created_at');
    }

    /** Entrenador aceptado de este competidor (devuelve colección con 0 o 1 elemento) */
    public function entrenadores(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'entrenador_competidor', 'competidor_id', 'entrenador_id')
            ->wherePivot('estado', 'accepted');
    }

    protected function rolNivel(): int
    {
        return match($this->rol) {
            'admin'      => 4,
            'arbitro'    => 3,
            'entrenador' => 2,
            'competidor' => 1,
            default      => 0,
        };
    }

    public function isAdmin(): bool      { return $this->rolNivel() >= 4; }
    public function isArbitro(): bool    { return $this->rolNivel() >= 3; }
    public function isEntrenador(): bool { return $this->rolNivel() >= 2; }
    public function isCompetidor(): bool { return $this->rolNivel() >= 1; }

    /** Competiciones en las que este usuario es árbitro asignado */
    public function competicionesArbitradas()
    {
        return $this->hasMany(\App\Models\Competicion::class, 'arbitro_id');
    }
}
