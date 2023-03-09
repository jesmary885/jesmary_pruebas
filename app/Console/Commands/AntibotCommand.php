<?php

namespace App\Console\Commands;

use App\Models\Antibot;
use Illuminate\Console\Command;

class AntibotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'antibot:create';

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
        $antibots = [
            [
                'nro1' => '1',
                'nro2' => '1',
                'resultado' => '2',
            ],
            [
                'nro1' => '1',
                'nro2' => '2',
                'resultado' => '3',
            ],
            [
                'nro1' => '1',
                'nro2' => '3',
                'resultado' => '4',
            ],
            [
                'nro1' => '1',
                'nro2' => '5',
                'resultado' => '6',
            ],
            [
                'nro1' => '1',
                'nro2' => '6',
                'resultado' => '7',
            ],
            [
                'nro1' => '1',
                'nro2' => '7',
                'resultado' => '8',
            ],
            [
                'nro1' => '1',
                'nro2' => '8',
                'resultado' => '9',
            ],
            [
                'nro1' => '1',
                'nro2' => '9',
                'resultado' => '10',
            ],
            [
                'nro1' => '2',
                'nro2' => '0',
                'resultado' => '2',
            ],
            [
                'nro1' => '2',
                'nro2' => '1',
                'resultado' => '3',
            ],
            
           
        ];

        foreach ($antibots as $antibot) {
            Antibot::create($antibot);
        }
    }
}
