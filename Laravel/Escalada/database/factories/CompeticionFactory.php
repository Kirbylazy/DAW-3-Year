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
            'copa_id' => Copa::factory(), 
            'name' => $this->faker->city() . ' Copa',
            'provincia' => $this->faker->randomElement([
                'Huelva',
                'Sevilla',
                'Cádiz',
                'Málaga',
                'Granada',
                'Córdoba',
                'Jaen',
                'Almería'
            ]),
            'fecha_realizacion' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            'tipo' => $this->faker->randomElement([
                'bloque',
                'cuerda',
                'velocidad'
            ]),
            'ubicacion_id' => Ubicacion::factory(),
            'campeonato' => $this->faker->boolean(30),
        ];
    }
}
