<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kkn_anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim')->nullable();
            $table->string('prodi')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('foto')->nullable(); // path file foto
            $table->string('badge')->nullable(); // 'ketua', 'developer', atau null
            $table->text('proker')->nullable(); // deskripsi program kerja
            $table->json('sdg')->nullable(); // array angka SDG, e.g. [8, 9]
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kkn_anggota');
    }
};
