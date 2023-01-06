<?php

namespace Database\Seeders;

use App\Models\CategoryMarketplace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryMarketplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Categoria 1',
            ],
            [
                'name' => 'Categoria 2',
            ],
            [
                'name' => 'Categoria 3',
            ],
            [
                'name' => 'Categoria 4',
            ],
        ];

        foreach ($categories as $category) {
            CategoryMarketplace::create($category);
        }
    }
}
