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
            [
                'nro1' => '2',
                'nro2' => '2',
                'resultado' => '4',
            ],
            [
                'nro1' => '2',
                'nro2' => '3',
                'resultado' => '5',
            ],
            [
                'nro1' => '2',
                'nro2' => '4',
                'resultado' => '6',
            ],
            [
                'nro1' => '2',
                'nro2' => '5',
                'resultado' => '7',
            ],
            [
                'nro1' => '2',
                'nro2' => '6',
                'resultado' => '8',
            ],
            [
                'nro1' => '2',
                'nro2' => '7',
                'resultado' => '9',
            ],
            [
                'nro1' => '2',
                'nro2' => '8',
                'resultado' => '10',
            ],
            [
                'nro1' => '2',
                'nro2' => '9',
                'resultado' => '11',
            ],
            [
                'nro1' => '2',
                'nro2' => '10',
                'resultado' => '12',
            ],
            [
                'nro1' => '3',
                'nro2' => '1',
                'resultado' => '4',
            ],
            [
                'nro1' => '3',
                'nro2' => '2',
                'resultado' => '6',
            ],
            [
                'nro1' => '3',
                'nro2' => '3',
                'resultado' => '6',
            ],
            [
                'nro1' => '3',
                'nro2' => '4',
                'resultado' => '7',
            ],
            [
                'nro1' => '3',
                'nro2' => '5',
                'resultado' => '8',
            ],
            [
                'nro1' => '3',
                'nro2' => '6',
                'resultado' => '9',
            ],
            [
                'nro1' => '3',
                'nro2' => '7',
                'resultado' => '10',
            ],
            [
                'nro1' => '3',
                'nro2' => '8',
                'resultado' => '11',
            ],
            [
                'nro1' => '3',
                'nro2' => '9',
                'resultado' => '12',
            ],
            [
                'nro1' => '3',
                'nro2' => '10',
                'resultado' => '30',
            ],
            [
                'nro1' => '4',
                'nro2' => '1',
                'resultado' => '5',
            ],
            [
                'nro1' => '4',
                'nro2' => '2',
                'resultado' => '6',
            ],
            [
                'nro1' => '4',
                'nro2' => '3',
                'resultado' => '7',
            ],
            [
                'nro1' => '4',
                'nro2' => '4',
                'resultado' => '8',
            ],
            [
                'nro1' => '4',
                'nro2' => '5',
                'resultado' => '9',
            ],
            [
                'nro1' => '4',
                'nro2' => '6',
                'resultado' => '10',
            ],
            [
                'nro1' => '4',
                'nro2' => '0',
                'resultado' => '4',
            ],
            [
                'nro1' => '5',
                'nro2' => '1',
                'resultado' => '6',
            ],
            [
                'nro1' => '5',
                'nro2' => '2',
                'resultado' => '7',
            ],
            [
                'nro1' => '5',
                'nro2' => '3',
                'resultado' => '8',
            ],
            
            [
                'nro1' => '5',
                'nro2' => '4',
                'resultado' => '9',
            ],
            [
                'nro1' => '5',
                'nro2' => '5',
                'resultado' => '10',
            ],

            [
                'nro1' => '6',
                'nro2' => '0',
                'resultado' => '6',
            ],
            [
                'nro1' => '6',
                'nro2' => '1',
                'resultado' => '7',
            ],
            [
                'nro1' => '6',
                'nro2' => '2',
                'resultado' => '8',
            ],
            [
                'nro1' => '6',
                'nro2' => '3',
                'resultado' => '9',
            ],
           
            [
                'nro1' => '6',
                'nro2' => '4',
                'resultado' => '10',
            ],

            [
                'nro1' => '7',
                'nro2' => '0',
                'resultado' => '7',
            ],
            [
                'nro1' => '7',
                'nro2' => '1',
                'resultado' => '8',
            ],
        ];

        foreach ($antibots as $antibot) {
            Antibot::create($antibot);
        }
    }
}
