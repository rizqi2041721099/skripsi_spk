<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('price_food', function (Blueprint $table) {
            $table->id();
            $table->string('standa_name');
            $table->string('range_price');
            $table->timestamps();
        });
    }
};
