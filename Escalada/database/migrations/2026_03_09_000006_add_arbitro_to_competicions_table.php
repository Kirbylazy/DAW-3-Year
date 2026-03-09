<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competicions', function (Blueprint $table) {
            $table->foreignId('arbitro_id')
                ->nullable()
                ->after('copa_id')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('competicions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('arbitro_id');
        });
    }
};
