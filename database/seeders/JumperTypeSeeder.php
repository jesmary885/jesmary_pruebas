<?php

namespace Database\Seeders;

use App\Models\JumperType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JumperTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumpers = [
            [
                'name' => 'BASIC',
            ],
            [
                'name' => 'HIGH',
            ],
            [
                'name' => 'CINT',
            ],
            [
                'name' => 'INTERNALS',
            ],
            
            [
                'name' => 'K1000',
            ],
            [
                'name' => 'K1092',
            ],
            [
                'name' => 'K2062',
            ],
            [
                'name' => 'K23',
            ],
            [
                'name' => 'K7341',
            ],
            [
                'name' => 'PRODEGE',
            ],
            [
                'name' => 'SAMPLICIO',
            ],
            [
                'name' => 'SCUBE',
            ],
            [
                'name' => 'SPECTRUM',
            ],
            [
                'name' => 'TOLUNA',
            ],
            [
                'name' => 'SIN IDENTIFICAR',
            ],
        ];

        foreach ($jumpers as $jumper) {
            JumperType::create($jumper);
        }
    }
}
