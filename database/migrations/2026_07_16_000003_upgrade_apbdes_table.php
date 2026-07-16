<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('apbdes', function (Blueprint $table) {
            // Ubah enum jenis ke string agar fleksibel (bisa pendapatan, belanja, pembiayaan)
            $table->string('jenis', 50)->change();
            
            // Tambah kolom semula dan perubahan
            $table->bigInteger('nominal_semula')->default(0)->after('nominal');
            $table->bigInteger('nominal_perubahan')->default(0)->after('nominal_semula');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apbdes', function (Blueprint $table) {
            $table->dropColumn(['nominal_semula', 'nominal_perubahan']);
        });
    }
};
