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
        Schema::table('berita', function (Blueprint $table) {
            $table->unsignedInteger('shares')->default(0)->after('views');
        });
        Schema::table('wisata', function (Blueprint $table) {
            $table->unsignedInteger('shares')->default(0)->after('dislikes');
        });
        Schema::table('produk', function (Blueprint $table) {
            $table->unsignedInteger('shares')->default(0)->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('shares');
        });
        Schema::table('wisata', function (Blueprint $table) {
            $table->dropColumn('shares');
        });
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('shares');
        });
    }
};
