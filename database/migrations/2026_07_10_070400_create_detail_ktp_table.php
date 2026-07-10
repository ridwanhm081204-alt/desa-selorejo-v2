<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_ktp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->cascadeOnDelete();
            $table->enum('jenis_pengajuan', ['baru_17tahun', 'rusak', 'hilang', 'ubah_data']);
            $table->string('no_surat_kehilangan', 50)->nullable();
            $table->dateTime('jadwal_perekaman')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_ktp');
    }
};
