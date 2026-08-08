<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peta_titiks', function (Blueprint $table) {
            if (!Schema::hasColumn('peta_titiks', 'gmaps_link')) {
                $table->string('gmaps_link', 500)->nullable()->after('longitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('peta_titiks', function (Blueprint $table) {
            if (Schema::hasColumn('peta_titiks', 'gmaps_link')) {
                $table->dropColumn('gmaps_link');
            }
        });
    }
};
