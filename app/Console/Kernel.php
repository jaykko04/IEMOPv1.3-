<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Carbon\Carbon;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       Commands\CronJob::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
          // $schedule->command('cron:job')
          //        ->everyMinute();

        $schedule->call(function () {
 
           $compliance = DB::table('compliance')
           ->select('*')
           ->union(DB::table('compliance_min'))
            ->union(DB::table('compliance_mandatedparticipants'))
             ->union(DB::table('compliance_mandatedparticipants_min'))
            ->get();

            $compliance_tbl = DB::table('compliance_tbl')
            ->select('compliance_percentage')
            ->get();

           
                foreach ($compliance_tbl as $compliance_tbl) {
                         } 

             foreach ($compliance as $compliance) {

             $compliance_rec = $compliance->totalMQ * $compliance_tbl->compliance_percentage;
             $total_compliance_rec = $compliance->totalMQ + $compliance_rec;
                 $recertificate = DB::table('Recertificate')
                    ->select('*')
                    ->where('generatorname','=',$compliance->customerfinalnew)
                    ->count();
                    $total = $recertificate - $compliance_rec;
                   
                        $data2 = array("ownername"=>$compliance->customerfinalnew,"total_mq"=>$compliance->totalMQ,"compliance_rec"=>$compliance_rec,"total_surrender"=>$total,"compliance_percentage"=>$compliance_tbl->compliance_percentage,"total_deficiency"=>"0","date_generated"=>"2017-12-26","updated_by"=>"Admin");  
                        
               DB::table('compliance_main')->insert($data2);
          }

        })->everyMinute();

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
