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
        $copas = \App\Models\Copa::factory()->count(2)->create();
        $ubis  = \App\Models\Ubicacion::factory()->count(6)->create();

        \App\Models\Competicion::factory()->count(3)->create([
        'copa_id' => $copas[0]->id,
        'ubicacion_id' => $ubis[0]->id,
        ]);

        \App\Models\Competicion::factory()->count(3)->create([
        'copa_id' => $copas[1]->id,
        'ubicacion_id' => $ubis[1]->id,
        ]);

        \App\Models\User::factory()->count(300)->create();

    }
}