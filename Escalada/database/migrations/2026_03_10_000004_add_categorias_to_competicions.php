<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competicions', function (Blueprint $table) {
            $table->json('categorias')->nullable()->after('campeonato');
        });
    }

    public function down(): void
    {
        Schema::table('competicions', function (Blueprint $table) {
            $table->dropColumn('categorias');
        });
    }
};
