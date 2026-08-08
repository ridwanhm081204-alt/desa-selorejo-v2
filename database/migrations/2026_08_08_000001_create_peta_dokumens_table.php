<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peta_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('file_path')->nullable();
            $table->string('skala')->nullable();        // mis. "1:3.500"
            $table->string('sistem_koordinat')->nullable(); // "WGS 1984 UTM Zone 49S"
            $table->string('proyeksi')->nullable();     // "Transverse Mercator"
            $table->string('datum')->nullable();        // "WGS 1984"
            $table->text('sumber_data')->nullable();
            $table->string('dibuat_oleh')->nullable();
            $table->integer('urutan_tampil')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peta_dokumens');
    }
};
