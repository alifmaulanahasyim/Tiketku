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
Schema::create('destinasi_wisata', function (Blueprint $table) {
    $table->id();
    $table->string('nama_wisata');
    $table->string('lokasi');
    $table->text('deskripsi')->nullable();
    $table->decimal('harga_tiket', 10, 2)->default(10000);
    $table->string('gambar')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi_wisata');
    }
};
