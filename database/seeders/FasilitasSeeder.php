<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FasilitasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'WI-FI'],
            ['name' => 'AC'],
            ['name' => 'Tempat Parkir'],
            ['name' => 'Toilet'],
            ['name' => 'Bar'],
            ['name' => 'Are Bermain Anak'],
            ['name' => 'Aksesibilitas'],
            ['name' => 'TV'],
            ['name' => 'Live Music'],
            ['name' => 'Pesan Antar'],
            ['name' => 'Ruangan Outdoor'],
            ['name' => 'Ruangan Rapat'],
            ['name' => 'Parkir Bus / Kendaraaan Besar'],
            ['name' => 'Area Bebas Rokok'],
            ['name' => 'Booking Room'],
            ['name' => 'Area Lounge'],
            ['name' => 'Waktu Operasional'],
            ['name' => 'Musholla'],
        ];

        Facility::insert($data);
    }
}
