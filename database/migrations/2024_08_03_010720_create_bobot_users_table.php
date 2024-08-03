<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bobot_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('bobot_harga_makanan');
            $table->string('bobot_jarak');
            $table->string('bobot_fasilitas');
            $table->string('bobot_jam_operasional');
            $table->string('bobot_variasi_menu');
            $table->timestamps();
        });
    }
};
