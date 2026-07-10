<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_akta_kematian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->cascadeOnDelete();
            $table->string('nik_almarhum', 16);
            $table->string('nama_almarhum', 100);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('tempat_meninggal', 100);
            $table->date('tanggal_meninggal');
            $table->string('sebab_kematian', 255)->nullable();
            $table->string('nama_pelapor', 100);
            $table->string('nik_pelapor', 16);
            $table->string('hubungan_pelapor', 50);
            $table->boolean('identitas_jelas')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_akta_kematian');
    }
};
