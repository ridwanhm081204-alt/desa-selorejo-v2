<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peta_titiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            // 11 kategori sesuai Peta A (§2.2 task spec)
            $table->string('kategori');
            // gumuk | krajan | selokerto
            $table->string('dusun');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            // true untuk 7 destinasi Peta B
            $table->boolean('is_wisata_unggulan')->default(false);
            $table->string('sumber_data')->nullable();
            $table->integer('urutan_tampil')->default(0);
            // FK nullable ke umkms & wisata untuk titik yang overlap
            $table->foreignId('umkm_id')->nullable()->constrained('umkms')->nullOnDelete();
            $table->foreignId('wisata_id')->nullable()->constrained('wisata')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peta_titiks');
    }
};
