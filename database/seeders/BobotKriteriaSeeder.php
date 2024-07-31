<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BobotKriteria;

class BobotKriteriaSeeder extends Seeder
{
    public function run()
    {
        BobotKriteria::create([
            'bobot_harga_makanan'   => 30,
            'bobot_jarak'           => 25,
            'bobot_fasilitas'       => 25,
            'bobot_jam_operasional' => 10,
            'bobot_variasi_menu'    => 10
        ]);
    }
}
