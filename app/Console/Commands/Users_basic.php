<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Users_basic extends Command
{
   
    protected $signature = 'change_rol:user';
   
    protected $description = 'Command description';

    public function handle()
    {
        $users = User::all();

        foreach($users as $user){

            $rol_name = $user->roles->first()->name;

            if($rol_name == 'Encuestador Premium'){
                $user->roles()->sync(2);
            }

        }
    }
}
