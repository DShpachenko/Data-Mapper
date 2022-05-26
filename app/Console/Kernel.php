<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\Debug\Spec\OpenApiBuild;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

final class Kernel extends ConsoleKernel
{
    /**
     * @var array
     */
    protected $commands = [
        OpenApiBuild::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        //
    }
}
