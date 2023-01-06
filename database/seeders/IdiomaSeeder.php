<?php

namespace Database\Seeders;

use App\Models\Idioma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdiomaSeeder extends Seeder
{
    
    public function run()
    {
        $idiomas = [
            [
                'name' => 'Español',
            ],
            [
                'name' => 'English',
            ],
        ];

        foreach ($idiomas as $idioma) {
            Idioma::create($idioma);
        }
    }
}
