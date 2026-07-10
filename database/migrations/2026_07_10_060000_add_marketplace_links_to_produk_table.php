<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('link_shopee', 500)->nullable()->after('whatsapp');
            $table->string('link_tokopedia', 500)->nullable()->after('link_shopee');
            $table->string('link_marketplace_lainnya', 500)->nullable()->after('link_tokopedia');
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn(['link_shopee', 'link_tokopedia', 'link_marketplace_lainnya']);
        });
    }
};
