<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->string('user_id');
            $table->string('restaurant_id');
            $table->string('parent_id')->nullable();
            $table->string('likes')->default(0);
            $table->timestamps();
        });
    }
};
