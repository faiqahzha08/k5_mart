<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {

            $table->foreignId('jenis_produk_id')
                ->nullable()
                ->after('jenis_produk')
                ->constrained('jenis_produks')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {

            $table->dropForeign([
                'jenis_produk_id'
            ]);

            $table->dropColumn('jenis_produk_id');

        });
    }
};