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
        $datetoday = Carbon::now();
          
           $schedule_transact = DB::table('schedule')
           ->select('*')
            ->get();
                
          foreach ($schedule_transact as $key) {
               
                    if($key->sched_date_transfer == $datetoday->toDateString())
                    {  
                          if($key->Status =='Success')
                            {

                            }
                            else
                            {

                                for($x=0; $x < $key->volume; $x++)
                                                            {
                                                            $serialnumber['data'] = DB::table('recertificate')
                                                             ->select('*')
                                                             ->where('ownername', '=', $key->ownername)
                                                             ->orderby('serialnumber','ASC')
                                                             ->skip($x)
                                                             ->take(1)
                                                             ->get();

                                                                foreach ($serialnumber['data'] as $cert) {
                                                            $data = array('serialnumber'=>$cert->serialnumber,
                                                              "original_ownername"=>$cert->ownername,
                                                              "ownername"=>$key->ownername,
                                                              "newownername"=>$key->newownername,
                                                              "generatorname"=>$cert->generatorname,
                                                              "customerName"=>$cert->customerName,
                                                              "xferRequested_by"=>$key->ownername,
                                                              "xferRequestDate"=>$key->sched_date_transfer,
                                                              "xferStatus"=>'A',
                                                              "technology"=>$cert->technology,
                                                              "vintage"=>$cert->vintage,
                                                              "startDate"=>$cert->startDate,
                                                              "endDate"=>$cert->endDate,
                                                              "dateissued"=>$cert->dateissued,
                                                              "expirydate"=>$cert->expirydate,
                                                              "IDParent"=>$cert->IDParent,
                                                              "typeFit"=>$cert->typeFIT,
                                                              "Main_ID"=>$cert->ID);

                                                               DB::table('rectransfer')->insert($data);
                                                            $delete = DB::table('recertificate')
                                                               ->where('serialnumber',$cert->serialnumber)
                                                               ->delete();
                                                                                                        }
                                                                                                       
                                                            }
                       DB::table('schedule')
                         ->where('id', $key->id)
                         ->update(['Status' => "Success",'Remarks' => "Successfully Transferred ".$key->volume." RECs"]);
                             }
                                
                    }
                    else if($key->sched_date_transfer == $datetoday->format('Y-m')){

                            if($key->Status =='Success')
                            {

                            }
                            else
                            {
                                    $recs = DB::table('compliance')
                                     ->select(DB::raw('SUM(totalrecs) AS totalrecs'))
                                     ->where('ownername', '=', $key->ownername)
                                     ->get();
                                    foreach ($recs as $recs) {
                                         }
                                       if($recs->totalrecs >= $key->volume)
                                       {
                                                    
                                                    for($x=0; $x < $key->volume; $x++)
                                                            {
                                                            $serialnumber['data'] = DB::table('recertificate')
                                                             ->select('*')
                                                             ->where('ownername', '=', $key->ownername)
                                                             ->orderby('serialnumber','ASC')
                                                             ->skip($x)
                                                             ->take(1)
                                                             ->get();

                                                                foreach ($serialnumber['data'] as $cert) {
                                                            $data = array('serialnumber'=>$cert->serialnumber,
                                                              "original_ownername"=>$cert->ownername,
                                                              "ownername"=>$key->ownername,
                                                              "newownername"=>$key->newownername,
                                                              "generatorname"=>$cert->generatorname,
                                                              "customerName"=>$cert->customerName,
                                                              "xferRequested_by"=>$key->ownername,
                                                              "xferRequestDate"=>$key->sched_date_transfer,
                                                              "xferStatus"=>'A',
                                                              "technology"=>$cert->technology,
                                                              "vintage"=>$cert->vintage,
                                                              "startDate"=>$cert->startDate,
                                                              "endDate"=>$cert->endDate,
                                                              "dateissued"=>$cert->dateissued,
                                                              "expirydate"=>$cert->expirydate,
                                                              "IDParent"=>$cert->IDParent,
                                                              "typeFit"=>$cert->typeFIT,
                                                              "Main_ID"=>$cert->ID);

                                                               DB::table('rectransfer')->insert($data);
                                                            $delete = DB::table('recertificate')
                                                               ->where('serialnumber',$cert->serialnumber)
                                                               ->delete();
                                                                                                        }
                                                                                                       
                                                            }


                                         DB::table('schedule')
                                        ->where('id', $key->id)
                                        ->update(['Status' => "Success",'Remarks' => "Successfully Transferred ".$key->volume." RECs"]);
                                
                                       }
                                       else
                                       {
                                         DB::table('schedule')
                                        ->where('id', $key->id)
                                        ->update(['Status' => "Failed",'Remarks' => "Failed to Transfer ".$key->volume." RECs"]);
                                
                                       }                                                 
                            }
                                    }
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
