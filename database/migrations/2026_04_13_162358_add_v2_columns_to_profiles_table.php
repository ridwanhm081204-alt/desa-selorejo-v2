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
        Schema::table('profiles', function (Blueprint $table) {
            $table->json('hero_sejarah')->nullable();
            $table->json('hero_visimisi')->nullable();
            $table->json('hero_geografi')->nullable();
            $table->json('hero_peta')->nullable();
            $table->string('motto')->nullable();
            $table->json('dusun_info')->nullable();
            $table->string('peta_image')->nullable();
            $table->text('peta_narasi_utama')->nullable();
            $table->text('peta_narasi_legenda')->nullable();
            $table->json('peta_fasilitas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'hero_sejarah', 'hero_visimisi', 'hero_geografi', 'hero_peta',
                'motto', 'dusun_info', 'peta_image', 'peta_narasi_utama',
                'peta_narasi_legenda', 'peta_fasilitas'
            ]);
        });
    }
};
