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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->string('slug', 200)->unique();
            $table->longText('konten');
            $table->string('gambar', 255)->nullable();
            $table->enum('kategori', ['Kabar Desa', 'Pengumuman', 'Info Wisata', 'Kegiatan KKN']);
            $table->date('tanggal');
            $table->string('penulis', 100)->nullable();
            $table->enum('status_publish', ['draft', 'publish'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
