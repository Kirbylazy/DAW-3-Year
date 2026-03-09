<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['email' => 'arbitro@escalada.com'], [
            'name'             => 'arbitro',
            'password'         => bcrypt('password'),
            'rol'              => 'arbitro',
            'dni'              => '11111111B',
            'fecha_nacimiento' => '1988-03-20',
            'provincia'        => 'Sevilla',
            'talla'            => 'M',
            'genero'           => 'otro',
        ]);

        User::firstOrCreate(['email' => 'entrenador@escalada.com'], [
            'name'             => 'entrenador',
            'password'         => bcrypt('password'),
            'rol'              => 'entrenador',
            'dni'              => '11111111A',
            'fecha_nacimiento' => '1985-05-15',
            'provincia'        => 'Madrid',
            'talla'            => 'L',
            'genero'           => 'otro',
        ]);

        foreach (range(1, 5) as $i) {
            User::firstOrCreate(['email' => "competidor{$i}@escalada.com"], [
                'name'             => "competidor{$i}",
                'password'         => bcrypt('password'),
                'rol'              => 'competidor',
                'dni'              => "2222222{$i}B",
                'fecha_nacimiento' => '2000-01-0' . $i,
                'provincia'        => 'Madrid',
                'talla'            => 'M',
                'genero'           => 'otro',
            ]);
        }
    }
}
