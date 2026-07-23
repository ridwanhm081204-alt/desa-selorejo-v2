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
        Schema::create('layanan_syarat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_konten_id')->constrained('layanan_konten')->cascadeOnDelete();
            $table->string('kode_syarat', 50); // ex: file_ktp
            $table->string('nama_syarat', 200); // ex: SCAN KTP ORANG TUA
            $table->string('keterangan', 255)->nullable(); // ex: Format: PDF, JPG, PNG (Max 2MB)
            $table->boolean('is_required')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_syarat');
    }
};
