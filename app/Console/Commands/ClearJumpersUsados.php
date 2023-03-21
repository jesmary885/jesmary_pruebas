<?php

namespace App\Console\Commands;

use App\Models\Links_usados;
use Illuminate\Console\Command;

class ClearJumpersUsados extends Command
{
    protected $signature = 'clear:jump';

    protected $description = 'Command description';

    public function handle()
    {
        Links_usados::query()->delete();
    }
}
