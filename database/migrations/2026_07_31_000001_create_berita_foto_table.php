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
        Schema::create('berita_foto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('berita_id');
            $table->string('path', 255);
            $table->integer('urutan')->default(0);
            $table->timestamps();

            $table->foreign('berita_id')->references('id')->on('berita')->onDelete('cascade');
            $table->index(['berita_id', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_foto');
    }
};
