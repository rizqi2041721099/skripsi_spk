<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->integer('like')->default(0)->after('user_id');
            $table->integer('dislike')->default(0)->after('like');
        });
    }
};
