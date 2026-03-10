<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('licencia_validaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('validada_por')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('competicion_id')->nullable()->constrained('competicions')->nullOnDelete();
            $table->enum('tipo', ['valida', 'valida_dia']);
            $table->date('valida_hasta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('licencia_validaciones');
    }
};
