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
        // ── Admin ────────────────────────────────────────────────────────────
        User::create([
            'name'             => 'admin',
            'email'            => 'admin@escalada.com',
            'password'         => bcrypt('admin'),
            'rol'              => 'admin',
            'dni'              => '00000000A',
            'fecha_nacimiento' => '1990-01-01',
            'provincia'        => 'Sevilla',
            'talla'            => 'M',
            'genero'           => 'otro',
        ]);

        // ── Copas ────────────────────────────────────────────────────────────
        $copaBloque = Copa::create([
            'name'      => 'Copa de Bloque 2026',
            'tipo'      => 'Bloque',
            'temporada' => 2026,
        ]);

        $copaDificultad = Copa::create([
            'name'      => 'Copa de Dificultad 2026',
            'tipo'      => 'Dificultad',
            'temporada' => 2026,
        ]);

        // ── Ubicaciones (una por provincia andaluza) ─────────────────────────
        $provincias = ['Sevilla', 'Málaga', 'Granada', 'Córdoba', 'Cádiz', 'Almería', 'Huelva', 'Jaén'];

        $ubicaciones = [];
        foreach ($provincias as $prov) {
            $ubicaciones[$prov] = Ubicacion::factory()->create(['provincia' => $prov]);
        }

        // ── Competiciones de Bloque ──────────────────────────────────────────
        Competicion::create([
            'name'              => '1ª Prueba de Bloque de Andalucía, Sevilla',
            'provincia'         => 'Sevilla',
            'tipo'              => 'bloque',
            'campeonato'        => false,
            'fecha_realizacion' => '2026-02-14 10:00:00',
            'copa_id'           => $copaBloque->id,
            'ubicacion_id'      => $ubicaciones['Sevilla']->id,
        ]);

        Competicion::create([
            'name'              => '2ª Prueba de Bloque de Andalucía, Málaga',
            'provincia'         => 'Málaga',
            'tipo'              => 'bloque',
            'campeonato'        => false,
            'fecha_realizacion' => '2026-03-21 10:00:00',
            'copa_id'           => $copaBloque->id,
            'ubicacion_id'      => $ubicaciones['Málaga']->id,
        ]);

        Competicion::create([
            'name'              => '3ª Prueba de Bloque y Campeonato de Andalucía, Granada',
            'provincia'         => 'Granada',
            'tipo'              => 'bloque',
            'campeonato'        => true,
            'fecha_realizacion' => '2026-05-09 10:00:00',
            'copa_id'           => $copaBloque->id,
            'ubicacion_id'      => $ubicaciones['Granada']->id,
        ]);

        // ── Competiciones de Dificultad ──────────────────────────────────────
        Competicion::create([
            'name'              => '1ª Prueba de Dificultad de Andalucía, Córdoba',
            'provincia'         => 'Córdoba',
            'tipo'              => 'dificultad',
            'campeonato'        => false,
            'fecha_realizacion' => '2026-10-10 10:00:00',
            'copa_id'           => $copaDificultad->id,
            'ubicacion_id'      => $ubicaciones['Córdoba']->id,
        ]);

        Competicion::create([
            'name'              => '2ª Prueba de Dificultad de Andalucía, Cádiz',
            'provincia'         => 'Cádiz',
            'tipo'              => 'dificultad',
            'campeonato'        => false,
            'fecha_realizacion' => '2026-11-14 10:00:00',
            'copa_id'           => $copaDificultad->id,
            'ubicacion_id'      => $ubicaciones['Cádiz']->id,
        ]);

        Competicion::create([
            'name'              => '3ª Prueba de Dificultad y Campeonato de Andalucía, Almería',
            'provincia'         => 'Almería',
            'tipo'              => 'dificultad',
            'campeonato'        => true,
            'fecha_realizacion' => '2026-12-05 10:00:00',
            'copa_id'           => $copaDificultad->id,
            'ubicacion_id'      => $ubicaciones['Almería']->id,
        ]);

        // ── Competición de Velocidad ─────────────────────────────────────────
        Competicion::create([
            'name'              => 'Prueba de Velocidad y Campeonato de Andalucía, Huelva',
            'provincia'         => 'Huelva',
            'tipo'              => 'velocidad',
            'campeonato'        => true,
            'fecha_realizacion' => '2026-06-20 10:00:00',
            'copa_id'           => null,
            'ubicacion_id'      => $ubicaciones['Huelva']->id,
        ]);

        // ── Usuarios de prueba y masivos ─────────────────────────────────────
        User::factory()->count(300)->create();

        $this->call(TestUsersSeeder::class);
        $this->call(InscripcionesSeeder::class);
    }
}
