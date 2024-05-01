<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('food_variaties', function (Blueprint $table) {
            $table->string('restaurant_id');
            $table->double('price',14,2);
        });
    }
};
