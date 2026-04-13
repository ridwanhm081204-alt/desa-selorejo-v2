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
            // Sejarah
            $table->json('sejarah_timeline')->after('sejarah')->nullable();
            
            // Visi Misi
            $table->text('visi')->after('sejarah_timeline')->nullable();
            $table->json('misi')->after('visi')->nullable();
            
            // Geografi
            $table->json('geografi_stats')->after('geografi')->nullable();
            $table->json('batas_wilayah_json')->after('batas_wilayah')->nullable();
            
            // Peta
            $table->text('peta_deskripsi')->after('peta_embed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'sejarah_timeline',
                'visi',
                'misi',
                'geografi_stats',
                'batas_wilayah_json',
                'peta_deskripsi'
            ]);
        });
    }
};
