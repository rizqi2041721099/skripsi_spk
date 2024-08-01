<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alternatifs', function (Blueprint $table) {
            $table->string('v_harga_makanan')->change();
            $table->string('v_variasi_makanan')->change();
            $table->string('v_jam_operasional')->change();
            $table->string('v_jarak')->change();
            $table->string('v_fasilitas')->change();
        });
    }
};
