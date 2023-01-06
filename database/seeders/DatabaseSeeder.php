<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoryMarketplace;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JumperTypeSeeder::class);
        $this->call(IdiomaSeeder::class);
        $this->call(CategoryMarketplaceSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
    }
}
