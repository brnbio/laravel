<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 *
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * @var array
     */
    protected $commands = [];

    /**
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . DIRECTORY_SEPARATOR . 'Commands');
    }
}
