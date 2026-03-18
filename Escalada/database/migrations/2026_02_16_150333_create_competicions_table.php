<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competicions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('copa_id')
                  ->nullable()
                  ->constrained('copas')
                  ->nullOnDelete();

            $table->foreignId('arbitro_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('ubicacion_id')
                  ->constrained('ubicacions')
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('provincia');
            $table->dateTime('fecha_realizacion');
            $table->dateTime('fecha_fin')->nullable();
            $table->string('tipo');
            $table->boolean('campeonato')->default(false);
            $table->json('categorias')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competicions');
    }
};
