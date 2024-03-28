<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KriteriaRasa;

class KriteriaRasaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'value' => 5,
                'standard_value' => 'Sangat Lezat',
            ],
            [
                'value' => 4,
                'standard_value' => 'Lezat',
            ],
            [
                'value' => 3,
                'standard_value' => 'Cukup',
            ],
            [
                'value' => 2,
                'standard_value' => 'Tidak Lezat',
            ],
            [
                'value' => 1,
                'standard_value' => 'Sangat Tidak Lezat',
            ],
        ];

        KriteriaRasa::insert($data);
    }
}
