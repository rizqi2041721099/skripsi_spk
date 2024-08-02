<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alternatifs_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name_restaurant');
            $table->string('v_harga_makanan');
            $table->string('v_variasi_makanan');
            $table->string('v_jam_operasional');
            $table->string('v_jarak');
            $table->string('v_fasilitas');
            $table->string('bobot_harga_makanan');
            $table->string('bobot_jarak');
            $table->string('bobot_fasilitas');
            $table->string('bobot_jam_operasional');
            $table->string('bobot_variasi_menu');
            $table->timestamps();
        });
    }
};
