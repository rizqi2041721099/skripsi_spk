<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bobot_kriterias', function (Blueprint $table) {
            $table->string('bobot_harga_makanan')->change();
            $table->string('bobot_jarak')->change();
            $table->string('bobot_fasilitas')->change();
            $table->string('bobot_jam_operasional')->change();
            $table->string('bobot_variasi_menu')->change();
        });
    }
};
