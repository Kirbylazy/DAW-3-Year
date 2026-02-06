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
                  ->constrained('copas')
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('provincia');
            $table->dateTime('fecha_realizacion');
            $table->string('tipo');

            $table->foreignId('ubicacion_id')
                  ->constrained('ubicacions')
                  ->cascadeOnDelete();

            $table->boolean('campeonato');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competicions');
    }
};
