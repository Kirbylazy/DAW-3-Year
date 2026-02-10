<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Copa;
use App\Models\Competicion;
use App\Models\Ubicacion;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Crear 2 copas
        $copas = Copa::factory()->count(2)->create();

        // 2) Crear ubicaciones (mínimo 6 para que cada competición pueda tener una distinta)
        $ubicaciones = Ubicacion::factory()->count(6)->create();

        // 3) Crear 6 competiciones: 3 para la copa 1 y 3 para la copa 2
        Competicion::factory()
            ->count(3)
            ->create([
                'copa_id' => $copas[0]->id,
                'ubicacion_id' => $ubicaciones->random()->id, // o asigna una fija si quieres
            ]);

        Competicion::factory()
            ->count(3)
            ->create([
                'copa_id' => $copas[1]->id,
                'ubicacion_id' => $ubicaciones->random()->id,
            ]);

        // 4) Crear 300 usuarios (competidores)
        User::factory()->count(300)->create();
    }
}