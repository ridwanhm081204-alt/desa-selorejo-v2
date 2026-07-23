<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_konten', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // akta_kelahiran, akta_kematian, kk, ktp
            $table->string('nama');           // Nama tampilan
            $table->text('deskripsi')->nullable();
            $table->string('warna_hex', 20)->default('#1A5C38'); // hex color utama
            $table->string('icon_name', 50)->default('file-text'); // lucide icon
            $table->string('route_name')->nullable(); // layanan.akta-kelahiran dsb
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_konten');
    }
};
