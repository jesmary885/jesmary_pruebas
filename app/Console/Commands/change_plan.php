<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class change_plan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizar:plan_user';

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

            $role_id = $user->roles->first()->id;

            if($role_id == '2'){
                if($user->type == 'basico'){
                    $user->update([
                        'plan' => '30'
                    ]);
                }
            }

            if($role_id == '10'){
                if($user->type == 'premium 30'){
                    $user->update([
                        'plan' => '30'
                    ]);
                }

                if($user->type == 'premium 10'){
                    $user->update([
                        'plan' => '10'
                    ]);
                }

                if($user->type == 'premium 2'){
                    $user->update([
                        'plan' => '2'
                    ]);
                }

                if($user->type == ''){
                    if($user->plan == '30'){
                        $user->update([
                            'type' => 'premium 30'
                        ]);
                    }

                    if($user->plan == '10'){
                        $user->update([
                            'type' => 'premium 10'
                        ]);

                    }

                    if($user->plan == '2'){
                        $user->update([
                            'type' => 'premium 2'
                        ]);
                    }
                }
            }
        }
    }
}
