<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class closeCommand extends Command
{
   
    protected $signature = 'close:user';

 
    protected $description = 'Command description';

    
    public function handle()
    {
        $users = User::all();

        foreach($users as $user){

            if($user->id != '1' &&
            $user->id != '2' &&
            $user->id != '3' &&
            $user->id != '4' &&
            $user->id != '5' &&
            $user->id != '6' &&
            $user->id != '7' &&
            $user->id != '8' &&
            $user->id != '9' &&
            $user->id != '10' &&
            $user->id != '11' &&
            $user->id != '14' &&
            $user->id != '22' &&
            $user->id != '45' &&
            $user->id != '55' &&
            $user->id != '58' &&
            $user->id != '59' &&
            $user->id != '60' &&
            $user->id != '61' &&
            $user->id != '63' &&
            $user->id != '69' &&
            $user->id != '238'){
                $user->roles()->sync(4);

                $user->update([
                    'type' => null 
                ]);

            }
        }
    }


}
