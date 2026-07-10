<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_akta_kelahiran', function (Blueprint $table) {
            $table->string('nama_ayah', 100)->nullable()->after('anak_ke');
            $table->string('nama_ibu', 100)->nullable()->after('nama_ayah');
        });
    }

    public function down(): void
    {
        Schema::table('detail_akta_kelahiran', function (Blueprint $table) {
            $table->dropColumn(['nama_ayah', 'nama_ibu']);
        });
    }
};
