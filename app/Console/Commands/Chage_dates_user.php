<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Chage_dates_user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:dates_users';

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
                $nueva_fecha_corte = date("Y-m-d h:s",strtotime($user->last_payment_date."+ 2 days"));
                
                $user->update([
                    'last_payment_date' => $nueva_fecha_corte,
                ]);

            }

            


        }

    }
}
