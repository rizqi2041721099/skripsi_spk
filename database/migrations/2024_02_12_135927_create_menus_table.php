<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('food_variaty_id');
            $table->string('flavor_id');
            $table->string('name');
            $table->double('price',14,2);
            $table->string('description')->nullable();
            $table->string('image');
            $table->timestamps();
        });
    }
};
