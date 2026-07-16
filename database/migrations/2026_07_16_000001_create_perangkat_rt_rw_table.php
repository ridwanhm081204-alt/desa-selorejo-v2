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
        Schema::create('perangkat_rt_rw', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['RT', 'RW']);
            $table->unsignedSmallInteger('nomor'); // nomor RT atau RW (misal: 1, 2, ..., 21)
            $table->string('nama', 100);
            $table->string('dusun', 100); // Dsn. Krajan, Dsn. Selokerto, Dsn. Gumuk
            $table->unsignedSmallInteger('nomor_rt')->nullable(); // hanya untuk jenis RT
            $table->unsignedSmallInteger('nomor_rw'); // berlaku untuk RT & RW
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_rt_rw');
    }
};
