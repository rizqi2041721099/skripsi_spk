<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'Harga Makanan',
                'category'      => '1',
                'description'   => 'Semakin tinggi nilai cost maka semakin rendah peluang untuk dipilih',
            ],
            [
                'name'          => 'Variasi Makanan',
                'category'      => '2',
                'description'   => 'Semakin tinggi nilai keuntungannya maka semakin tinggi peluang untuk dipilih',
            ],
            [
                'name'          => 'Jam Operasional',
                'category'      => '2',
                'description'   => 'Semakin tinggi nilai keuntungannya maka semakin tinggi peluang untuk dipilih',
            ],
            [
                'name'          => 'Jarak',
                'category'      => '1',
                'description'   => 'Semakin tinggi nilai cost maka semakin rendah peluang untuk dipilih',
            ],
            [
                'name'          => 'Fasilitas',
                'category'      => '2',
                'description'   => 'Semakin tinggi nilai keuntungannya maka semakin tinggi peluang untuk dipilih',
            ],
        ];

        Kriteria::insert($data);
    }
}
