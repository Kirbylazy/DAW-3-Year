<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Competicion;

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
        return $this->belongsToMany(Competicion::class, 'competicions_users', 'user_id', 'competicion_id')
            ->withPivot('tipoDato', 'dato')
            ->withTimestamps();
    }

    public function isAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    public function isArbitro(): bool
    {
        return $this->rol === 'arbitro';
    }

    public function isCompetidor(): bool
    {
        return $this->rol === 'competidor';
    }
}
