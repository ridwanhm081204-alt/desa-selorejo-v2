<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom keamanan untuk audit trail:
     * - activity_logs: ip_address, user_agent
     * - kontak_messages: ip_address
     */
    public function up(): void
    {
        // Tambah kolom ke activity_logs
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->string('ip_address', 45)->nullable()->after('action');
            $table->string('user_agent', 512)->nullable()->after('ip_address');
        });

        // Tambah kolom ke kontak_messages
        Schema::table('kontak_messages', function (Blueprint $table) {
            $table->string('ip_address', 45)->nullable()->after('pesan');
        });
    }

    /**
     * Rollback: hapus kolom keamanan yang ditambahkan.
     */
    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'user_agent']);
        });

        Schema::table('kontak_messages', function (Blueprint $table) {
            $table->dropColumn('ip_address');
        });
    }
};
