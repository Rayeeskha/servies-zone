<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CustomService;

class LogHistoryLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loghistory:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command delete User Login Log';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        (new CustomService())->deleteLastOneMonthLogs();
        $this->info('Cron command is working fine!');
    }
}
