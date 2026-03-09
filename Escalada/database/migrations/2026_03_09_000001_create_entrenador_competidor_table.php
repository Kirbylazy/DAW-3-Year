<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrenador_competidor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entrenador_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('competidor_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->enum('estado', ['pending', 'accepted'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrenador_competidor');
    }
};
