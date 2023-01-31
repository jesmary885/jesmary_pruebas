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
                'name' => 'PROXIES, VPS Y VPN',
            ],
            [
                'name' => 'GIFT CARD Y DIVISAS',
            ],
            [
                'name' => 'VERIFICACIONES',
            ],
            [
                'name' => 'TV STREAMING',
            ],
            [
                'name' => 'EQUIPOS TECNOLÓGICOS',
            ],
            [
                'name' => 'OTROS',
            ],
        ];

        foreach ($categories as $category) {
            CategoryMarketplace::create($category);
        }
    }
}
