<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        'App\Console\Commands\desact_user',
        'App\Console\Commands\RenovarMembresia',
 
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fecha_corte:desact')->everyMinute(); // corte cada minuto
        //$schedule->command('renovation:membresia')->everyMinute(); // renovacion cada minuto
        $schedule->command('eliminar:pago')->everyMinute(); // renovacion cada minuto
        $schedule->command('clear:jump')->dailyAt('00:00');
    
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
