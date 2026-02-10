<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competicions_users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('competicion_id')
                  ->constrained('competicions')
                  ->cascadeOnDelete();

            $table->string('rol');
            $table->timestamps();

            $table->unique(['user_id', 'competicion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competicions_users');
    }
};
