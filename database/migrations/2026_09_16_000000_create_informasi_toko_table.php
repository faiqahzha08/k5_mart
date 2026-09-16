<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_toko', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->string('tagline')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('produk_layanan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 30)->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        // Data awal tersedia langsung setelah migrate, tanpa menjalankan ulang seeder.
        DB::table('informasi_toko')->insert([
            'id' => 1,
            'nama_toko' => 'K5 Mart',
            'tagline' => 'Belanja nyaman, kebutuhan harian terpenuhi.',
            'deskripsi' => 'K5 Mart hadir untuk membantu memenuhi kebutuhan sehari-hari melalui pilihan produk yang beragam dan pelayanan yang ramah. Kenyamanan pelanggan menjadi bagian penting dalam setiap transaksi.',
            'sejarah' => 'Profil perjalanan K5 Mart akan dilengkapi oleh pengelola toko.',
            'visi' => 'Menjadi toko pilihan masyarakat yang menyediakan kebutuhan harian dengan pelayanan ramah, praktis, dan terpercaya.',
            'misi' => "Menyediakan produk kebutuhan sehari-hari yang berkualitas.\nMemberikan pelayanan yang ramah, cepat, dan jujur.\nMenjaga kebersihan serta kenyamanan tempat berbelanja.\nMengelola persediaan dan transaksi secara tertib untuk meningkatkan pelayanan.",
            'produk_layanan' => "Makanan dan minuman\nKebutuhan rumah tangga\nProduk kebutuhan sehari-hari\nPelayanan transaksi belanja",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_toko');
    }
};
