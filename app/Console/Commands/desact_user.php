<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;

class desact_user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fecha_corte:desact';

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
        $users = User::all();

        foreach($users as $user){

            if($user->last_payment_date){

                $date = new DateTime();
                $fecha_actual = date("Y-m-d H:i:s");
                $fecha_actual= new DateTime($fecha_actual);
                $proxima_fecha= new DateTime($user->last_payment_date);
                
                //$corte = Carbon::parse($user->last_payment_date);

            // $diasDiferencia = ($corte->diffInDays($fecha_actual));

                    if($fecha_actual > $proxima_fecha || $fecha_actual == $proxima_fecha ){
                        if($user->type != 'gratis'){
                        $user->roles()->sync(4);
                    }
                }

            }
        }
    }
}
