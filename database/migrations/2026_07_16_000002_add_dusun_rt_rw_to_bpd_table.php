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
        Schema::table('bpd', function (Blueprint $table) {
            $table->string('dusun', 100)->nullable();
            $table->unsignedSmallInteger('nomor_rt')->nullable();
            $table->unsignedSmallInteger('nomor_rw')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bpd', function (Blueprint $table) {
            $table->dropColumn(['dusun', 'nomor_rt', 'nomor_rw']);
        });
    }
};
