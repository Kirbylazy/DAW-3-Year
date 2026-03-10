<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inscripciones', function (Blueprint $table) {
            $table->enum('licencia_estado', ['valida', 'valida_dia', 'no_valida'])->nullable()->after('estado');
            $table->enum('pago_estado',     ['valida', 'valida_dia', 'no_valida'])->nullable()->after('licencia_estado');
            $table->text('licencia_motivo')->nullable()->after('pago_estado');
            $table->text('pago_motivo')->nullable()->after('licencia_motivo');
        });
    }

    public function down(): void
    {
        Schema::table('inscripciones', function (Blueprint $table) {
            $table->dropColumn(['licencia_estado', 'pago_estado', 'licencia_motivo', 'pago_motivo']);
        });
    }
};
