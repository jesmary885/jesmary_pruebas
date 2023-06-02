<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
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

            $fecha_actual = Carbon::now();

            $corte = Carbon::parse($user->last_payment_date);

            $diasDiferencia = ($corte->diffInDays($fecha_actual));

                if($corte <  $fecha_actual || $corte ==  $fecha_actual ){
                    if($user->type != 'gratis'){
                    $user->roles()->sync(4);

                 
                }
            }
        }
    }
}
