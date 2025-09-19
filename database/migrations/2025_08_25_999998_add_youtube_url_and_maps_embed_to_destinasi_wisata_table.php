<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('destinasi_wisata', function (Blueprint $table) {
            $table->string('youtube_url')->nullable();
            $table->text('maps_embed')->nullable();
        });
    }

    public function down()
    {
        Schema::table('destinasi_wisata', function (Blueprint $table) {
            $table->dropColumn(['youtube_url', 'maps_embed']);
        });
    }
};
