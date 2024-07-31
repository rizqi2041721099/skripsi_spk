<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriJamOperasional;

class KategoriJamOperasionalSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'value' => 5,
                'standard_value' => 'Skala 1',
                'range_value' => 'x < 4 jam',
            ],
            [
                'value' => 4,
                'standard_value' => 'Skala 2',
                'range_value' => '4 jam x < 8 jam',
            ],
            [
                'value' => 3,
                'standard_value' => 'Skala 3',
                'range_value' => '8 jam <= x < 12 jam',
            ],
            [
                'value' => 2,
                'standard_value' => 'Skala 4',
                'range_value' => '12 jam <= x < 16 jam',
            ],
            [
                'value' => 1,
                'standard_value' => 'Skala 5',
                'range_value' => 'x > 16 jam',
            ],
        ];

        KategoriJamOperasional::insert($data);
    }
}
