<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ubicacion>
 */
class UbicacionFactory extends Factory
{
    public function definition(): array
    {
        $provincias = ['Sevilla', 'Cádiz', 'Málaga', 'Granada', 'Córdoba', 'Huelva', 'Jaén', 'Almería'];

        return [
            'name' => 'Rocódromo ' . $this->faker->city(),
            'provincia' => $this->faker->randomElement($provincias),
            'direccion' => $this->faker->streetAddress(),

            // Medidas razonables de un muro/instalación (ajusta a tu gusto)
            'alto' => $this->faker->randomFloat(2, 3.0, 18.0),   // 3.00m - 18.00m
            'ancho' => $this->faker->randomFloat(2, 4.0, 35.0),  // 4.00m - 35.00m

            'n_lineas' => $this->faker->numberBetween(5, 60),
        ];
    }
}

