<?php

namespace App\Console\Commands;

use App\Models\PagoRegistrosRecarga;
use Illuminate\Console\Command;

class change_pagos_type extends Command
{
    protected $signature = 'change:pago_type';

    protected $description = 'Command description';

    public function handle()
    {
        $pagos = PagoRegistrosRecarga::all();

        foreach($pagos as $pago){
            if($pago->type == 'premium'){
               
                
                $pago->update([
                    'type' => 'premium 30',
                ]);

            }
        }

    }
}
