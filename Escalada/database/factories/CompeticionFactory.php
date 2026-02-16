<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Copa;
use App\Models\Ubicacion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competicion>
 */
class CompeticionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->city() . ' Copa',
            'provincia' => fake()->randomElement(['Huelva','Sevilla','Cádiz','Málaga','Granada','Córdoba','Jaén','Almería']),
            'fecha_realizacion' => fake()->dateTimeBetween('+1 week', '+1 year'),
            'tipo' => fake()->randomElement(['bloque','cuerda','velocidad']),
            'campeonato' => fake()->boolean(30),
        ];
    }
}
