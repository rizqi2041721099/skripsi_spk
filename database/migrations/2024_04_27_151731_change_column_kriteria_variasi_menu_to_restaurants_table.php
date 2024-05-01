<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('variasi_menu_id')->nullable()->change();
            $table->string('kriteria_harga_id')->nullable()->change();
        });
    }
};
