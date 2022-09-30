<?php

namespace App\Console\Commands\Time\Time;

use Illuminate\Console\Command;
use App\Repositories\Time\TimeRepository;

class TimeOutCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timeout:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a reminder to check out';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       //checkout
       (new TimeRepository())->chekoutReminder();
        $this->info('Display this on the screen');
    //    \Log::info("This is a reminder to check out");
    }
}
