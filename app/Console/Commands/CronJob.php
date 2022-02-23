<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\rectransfer_req;

use DB;
class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfered Successfully';

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
  \Log::info("Cron is working fine!");
 
           $this->info('Successfull!');
    }
}
