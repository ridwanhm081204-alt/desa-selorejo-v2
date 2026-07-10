<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_akta_kelahiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->cascadeOnDelete();
            $table->string('nama_anak', 100);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->time('jam_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('anak_ke');
            $table->decimal('berat_lahir', 5, 2)->nullable(); // Up to 999.99 kg/g
            $table->decimal('panjang_lahir', 5, 2)->nullable();
            $table->string('nik_ayah', 16);
            $table->string('nik_ibu', 16);
            $table->string('no_kk_orangtua', 16);
            $table->string('nama_saksi1', 100);
            $table->string('nik_saksi1', 16);
            $table->string('nama_saksi2', 100);
            $table->string('nik_saksi2', 16);
            $table->enum('tempat_penerbit_surat_lahir', ['rs', 'puskesmas', 'bidan', 'kepala_desa']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_akta_kelahiran');
    }
};
