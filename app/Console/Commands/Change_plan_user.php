<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Change_plan_user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:plan_premium';

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
            if($user->type == 'premium'){
                $user->update([
                    'type' => 'premium 30'
                ]);
            }
        }
    }
}
