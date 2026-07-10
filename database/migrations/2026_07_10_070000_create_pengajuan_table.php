<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('no_tiket', 30)->unique();
            $table->string('nik_pemohon', 16);
            $table->string('nama_pemohon', 100);
            $table->string('no_hp_pemohon', 15);
            $table->string('email_pemohon', 100)->nullable();
            $table->enum('jenis_layanan', [
                'akta_kelahiran',
                'akta_kematian',
                'kk_baru',
                'kk_tambah_anggota',
                'kk_ubah_data',
                'kk_pisah',
                'ktp_baru',
                'ktp_hilang',
                'ktp_rusak',
                'ktp_ubah_data'
            ]);
            $table->enum('status', ['diajukan', 'diverifikasi', 'diproses_disdukcapil', 'selesai', 'ditolak'])->default('diajukan');
            $table->text('catatan_admin')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
