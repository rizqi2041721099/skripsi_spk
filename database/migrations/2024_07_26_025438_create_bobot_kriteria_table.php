<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bobot_kriterias', function (Blueprint $table) {
            $table->id();
            $table->decimal('bobot_harga_makanan',10,2);
            $table->decimal('bobot_jarak',10,2);
            $table->decimal('bobot_fasilitas',10,2);
            $table->decimal('bobot_jam_operasional',10,2);
            $table->decimal('bobot_variasi_menu',10,2);
            $table->timestamps();
        });
    }
};
