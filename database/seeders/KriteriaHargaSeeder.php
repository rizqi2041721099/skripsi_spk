<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KriteriaHarga;

class KriteriaHargaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'value' => 5,
                'skala' => 'Skala 3',
                'standard_value' => 'Murah',
                'range_value' => 'Rp. 2.000,00 - Rp. 15.000,00'
            ],
            [
                'value' => 3,
                'skala' => 'Skala 2',
                'standard_value' => 'Normal',
                'range_value' => 'Rp. 15.000,00 - Rp. 25.000,00'
            ],
            [
                'value' => 1,
                'skala' => 'Skala 1',
                'standard_value' => 'Muhal',
                'range_value' => ' > Rp. 25.000,00'
            ],
        ];

        KriteriaHarga::insert($data);
    }
}
