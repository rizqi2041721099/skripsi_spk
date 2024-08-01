<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alternatifs', function (Blueprint $table) {
            $table->renameColumn('v_rasa_makanan','v_jam_operasional');
        });
    }
};
