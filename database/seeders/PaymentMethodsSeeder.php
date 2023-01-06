<?php

namespace Database\Seeders;

use App\Models\PaymentMethods;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metodos = [
            [
                'name' => 'Saldo en Página',
            ],
            [
                'name' => 'Pago móvil',
            ],
            [
                'name' => 'Transferencia',
            ],
            [
                'name' => 'Binance',
            ],
            [
                'name' => 'Paypal',
            ],
            [
                'name' => 'Skrill',
            ],
            [
                'name' => 'Zelle',
            ],
            [
                'name' => 'Zinli',
            ],
        ];

        foreach ($metodos as $metodo) {
            PaymentMethods::create($metodo);
        }
    }
}
