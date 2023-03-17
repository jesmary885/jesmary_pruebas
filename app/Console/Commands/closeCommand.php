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
       /* $users = User::all();

        foreach($users as $user){
            if($user->id != '1' && 
            $user->id != '1' && )
        }*/
    }


}
