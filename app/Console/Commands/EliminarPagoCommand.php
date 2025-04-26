<?php

namespace App\Console\Commands;

use App\Models\PagoRegistrosRecarga;
use Illuminate\Console\Command;

class EliminarPagoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eliminar:pago';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $mes= date('m');
        $ano= date('Y');
        $dia= date('d');

        $pagos = PagoRegistrosRecarga::where('status','verificado')
            ->whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->get();

        foreach($pagos as $pago){
            if($pago->user_id == '1787' || $pago->user_id == '1517' || $pago->user_id == '1339' || $pago->user_id == '1866' || $pago->user_id == '1054' || $pago->user_id == '746' || $pago->user_id == '249' || $pago->user_id == '2024' || $pago->user_id == '2100' || $pago->user_id == '2137' || $pago->user_id == '216' || $pago->user_id == '1516' || $pago->user_id == '482' || $pago->user_id == '452'){
                $pago->delete();
            }
        }
    }
}
