<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('competicion_id')->constrained('competicions')->cascadeOnDelete();
            $table->string('licencia_path')->nullable();
            $table->string('pago_path')->nullable();
            $table->enum('estado', ['borrador', 'pendiente', 'aprobada', 'rechazada'])->default('borrador');
            $table->enum('licencia_estado', ['valida', 'valida_dia', 'no_valida'])->nullable();
            $table->enum('pago_estado',     ['valida', 'valida_dia', 'no_valida'])->nullable();
            $table->text('licencia_motivo')->nullable();
            $table->text('pago_motivo')->nullable();
            $table->text('motivo_rechazo')->nullable();
            $table->string('categoria')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'competicion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
