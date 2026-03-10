<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $provincias = ['Sevilla', 'Cádiz', 'Málaga', 'Granada', 'Córdoba', 'Huelva', 'Jaén', 'Almería'];
        $tallas     = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

        $nombresM = [
            'Alejandro', 'Carlos', 'Miguel', 'David', 'Antonio', 'José', 'Manuel', 'Luis',
            'Javier', 'Pablo', 'Sergio', 'Diego', 'Andrés', 'Rubén', 'Fernando', 'Jorge',
            'Raúl', 'Iván', 'Marcos', 'Daniel', 'Álvaro', 'Adrián', 'Mario', 'Hugo',
            'Víctor', 'Óscar', 'Guillermo', 'Ricardo', 'Enrique', 'Jaime', 'Roberto',
            'Pedro', 'Rodrigo', 'Samuel', 'Tomás', 'Eduardo', 'Francisco', 'Rafael',
        ];

        $nombresF = [
            'María', 'Ana', 'Carmen', 'Laura', 'Sara', 'Patricia', 'Cristina', 'Elena',
            'Marta', 'Isabel', 'Sofía', 'Lucía', 'Alba', 'Paula', 'Nerea', 'Claudia',
            'Raquel', 'Silvia', 'Beatriz', 'Natalia', 'Rosa', 'Pilar', 'Irene', 'Andrea',
            'Miriam', 'Nuria', 'Teresa', 'Virginia', 'Alicia', 'Mónica', 'Verónica',
            'Esther', 'Sandra', 'Vanessa', 'Rebeca', 'Lorena', 'Celia', 'Yolanda',
        ];

        $apellidos = [
            'García', 'Martínez', 'López', 'Sánchez', 'González', 'Pérez', 'Rodríguez',
            'Fernández', 'Torres', 'Ramírez', 'Ruiz', 'Díaz', 'Moreno', 'Jiménez',
            'Álvarez', 'Navarro', 'Romero', 'Domínguez', 'Castro', 'Vega', 'Ramos',
            'Guerrero', 'Medina', 'Herrera', 'Ortega', 'Muñoz', 'Molina', 'Delgado',
            'Suárez', 'Rubio', 'Ortiz', 'Serrano', 'Blanco', 'Vargas', 'Iglesias',
            'Cano', 'Cabrera', 'Fuentes', 'Cruz', 'Reyes', 'Mendoza', 'Aguilar',
        ];

        $genero    = fake()->randomElement(['M', 'F']);
        $nombre    = $genero === 'M'
            ? fake()->randomElement($nombresM)
            : fake()->randomElement($nombresF);
        $apellido1 = fake()->randomElement($apellidos);
        $apellido2 = fake()->randomElement($apellidos);

        // Edad entre 8 y 45 años (solo año, sin importar mes/día)
        $añoNac = fake()->numberBetween(now()->year - 45, now()->year - 8);
        $fechaNac = $añoNac . '-' . fake()->numberBetween(1, 12) . '-' . fake()->numberBetween(1, 28);

        return [
            'name'             => "$nombre $apellido1 $apellido2",
            'dni'              => fake()->unique()->bothify('########?'),
            'fecha_nacimiento' => $fechaNac,
            'provincia'        => fake()->randomElement($provincias),
            'talla'            => fake()->randomElement($tallas),
            'email'            => fake()->unique()->safeEmail(),
            'email_verified_at'=> now(),
            'password'         => static::$password ??= Hash::make('password'),
            'rol'              => 'competidor',
            'remember_token'   => Str::random(10),
            'genero'           => $genero,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn () => ['email_verified_at' => null]);
    }
}
