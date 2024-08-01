<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kriteria_variasi_menus', function (Blueprint $table) {
            $table->string('skala')->after('value');
        });
    }
};
