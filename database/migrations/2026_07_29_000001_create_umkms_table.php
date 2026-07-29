<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('dusun'); // Krajan / Selokerto / Gumuk
            $table->string('nama_pemilik');
            $table->string('nama_usaha');
            $table->string('jenis_usaha'); // teks bebas dari data asli
            $table->string('kategori'); // hasil normalisasi, untuk filter & peta
            $table->string('no_telepon')->nullable();
            $table->string('username_sosmed')->nullable();
            $table->string('alamat_rt_rw')->nullable();
            $table->string('gmail_usaha')->nullable();
            $table->string('link_gmaps')->nullable();
            $table->string('nama_toko_gmaps')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            // terverifikasi / belum_terdaftar / perlu_dicek
            $table->string('status_lokasi')->default('perlu_dicek');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
