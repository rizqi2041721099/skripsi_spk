<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alternatifs_users', function (Blueprint $table) {
            $table->dropColumn('bobot_harga_makanan');
            $table->dropColumn('bobot_jarak');
            $table->dropColumn('bobot_fasilitas');
            $table->dropColumn('bobot_jam_operasional');
            $table->dropColumn('bobot_variasi_menu');
        });
    }
};
