<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('jenis_usaha');
            $table->string('jam_operasional')->nullable()->after('deskripsi');
            $table->string('produk_unggulan')->nullable()->after('jam_operasional');
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'jam_operasional', 'produk_unggulan']);
        });
    }
};
