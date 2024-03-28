<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kriteria_jaraks', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('standard_value');
            $table->string('range_value');
            $table->timestamps();
        });
    }
};
