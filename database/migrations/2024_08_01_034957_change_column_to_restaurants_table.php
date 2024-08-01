<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('kriteria_jarak_id')->nullable()->change();
            $table->string('kriteria_fasilitas_id')->nullable()->change();
            $table->string('jam_operasioanl');
            $table->string('active',1)->default(0);
        });
    }
};
