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

    protected $signature = 'change:dates_users';

    protected $description = 'Command description';

    public function handle()
    {
        $users = User::all();

        foreach($users as $user){
            if($user->last_payment_date){
                $nueva_fecha_corte = date("Y-m-d H:s",strtotime($user->last_payment_date."+ 17 hours"));
                
                $user->update([
                    'last_payment_date' => $nueva_fecha_corte,
                ]);

            }
        }

    }
}
