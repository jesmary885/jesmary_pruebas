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

            $rol_name = $user->roles->first()->name;
            $nueva_fecha_corte = date("Y-m-d h:s",strtotime($user->last_payment_date."+ 3 days"));
            $user->update([
                'rol_name' => $rol_name,
                'last_payment_date' => $nueva_fecha_corte,
                'last_logout' => null,
            ]);

            $user->roles()->sync(4);
        }

    }
}