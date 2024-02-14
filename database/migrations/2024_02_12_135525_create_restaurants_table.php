<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('facility_id');
            $table->string('menu_id');
            $table->string('name',200);
            $table->text('address',200);
            $table->integer('distance');
            $table->string('images');
            $table->string('added_by');
            $table->string('edit_by');
            $table->timestamps();
        });
    }
};
