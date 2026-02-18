<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $provincias = ['Sevilla', 'Cádiz', 'Málaga', 'Granada', 'Córdoba', 'Huelva', 'Jaén', 'Almería'];
        $tallas = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

        return [
            'dni' => fake()->unique()->bothify('########?'),
            'fecha_nacimiento' => fake()->date('Y-m-d', '-16 years'),
            'provincia' => fake()->randomElement($provincias),
            'talla' => fake()->randomElement($tallas),

            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),

            'password' => static::$password ??= Hash::make('password'),
            'rol' => 'competidor',

            'remember_token' => Str::random(10),

            'genero' => fake()->randomElement(['M', 'F']),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
        ]);
    }

    public function arbitro(): static
    {
        return $this->arbitro(fn(array $attributes)=>[
            'rol' => 'arbitro'
        ]);
    }

    public function entrenador(): static
    {
        return $this->arbitro(fn(array $attributes)=>[
            'rol' => 'entrenador'
        ]);
    }
}
