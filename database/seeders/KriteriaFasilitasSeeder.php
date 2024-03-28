<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KriteriaFasilitas;

class KriteriaFasilitasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'value' => 5,
                'standard_value' => 'Sangat Baik',
            ],
            [
                'value' => 4,
                'standard_value' => 'Baik',
            ],
            [
                'value' => 3,
                'standard_value' => 'Cukup Baik',
            ],
            [
                'value' => 2,
                'standard_value' => 'Tidak Baik',
            ],
            [
                'value' => 1,
                'standard_value' => 'Sangat Tidak Baik',
            ],
        ];

        KriteriaFasilitas::insert($data);
    }
}
