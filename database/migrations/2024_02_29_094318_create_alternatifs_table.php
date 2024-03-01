<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alternatifs', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_id');
            $table->double('v_harga_makanan')->default(0);
            $table->double('v_variasi_makanan')->default(0);
            $table->double('v_rasa_makanan')->default(0);
            $table->double('v_jarak')->default(0);
            $table->double('v_fasilitas')->default(0);
            $table->timestamps();
        });
    }
};
