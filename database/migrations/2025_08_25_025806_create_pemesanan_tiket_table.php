<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanan_tiket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nomor_identitas', 16);
            $table->string('no_hp', 15);
            $table->string('tempat_wisata');
            $table->date('tanggal_kunjungan');
            $table->integer('pengunjung_dewasa');
            $table->integer('pengunjung_anak');
            $table->decimal('harga_tiket', 10, 2)->default(10000);
            $table->decimal('total_bayar', 12, 2);
            $table->boolean('setuju_syarat')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan_tiket');
    }
};
