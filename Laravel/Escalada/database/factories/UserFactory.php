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
        $roles = ['deportista']; // ajusta a los roles reales de tu app

        return [
            'dni' => $this->faker->unique()->bothify('########?'), // ejemplo: 12345678Z
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-55 years', '-7 years'),
            'provincia' => $this->faker->randomElement($provincias),
            'talla' => $this->faker->randomElement($tallas),

            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),

            'password' => static::$password ??= Hash::make('password'),
            'rol' => $this->faker->randomElement($roles),

            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
        ]);
    }
}
