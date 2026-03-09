<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competicions_users', function (Blueprint $table) {
            if (!Schema::hasColumn('competicions_users', 'tipoDato')) {
                $table->string('tipoDato')->nullable()->after('competicion_id');
            }
            if (!Schema::hasColumn('competicions_users', 'dato')) {
                $table->string('dato')->nullable()->after('tipoDato');
            }
        });
    }

    public function down(): void
    {
        Schema::table('competicions_users', function (Blueprint $table) {
            $table->dropColumnIfExists('tipoDato');
            $table->dropColumnIfExists('dato');
        });
    }
};
