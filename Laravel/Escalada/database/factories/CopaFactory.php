<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Copa>
 */
class CopaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Copa de Andalucía',
            'tipo' => $this->faker->randomElement([
                'Bloque',
                'Cuerda',
                'Velocidad'
            ]),
            'temporada' => $this->faker->numberBetween(2023, 2026),
        ];
    }
}

