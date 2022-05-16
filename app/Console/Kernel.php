<?php

namespace App\Console;

use App\Console\Commands\NoteDescAndroid;
use App\Console\Commands\AddJobs;

use App\Console\Commands\RefreshWebsite;
use App\Console\Commands\SendWeb;
use App\Jobs\SendNoteAndroidJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //  NoteDescAndroid::class,
        RefreshWebsite::class,
        AddJobs::class,
      //  SendWeb::class

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        // $schedule->command('note:send')->everyFiveMinutes();
       //  $schedule->command('refresh:send')->everyFifteenMinutes();
       //  $schedule->command('add:jobs')->hourly(); //twiceDaily(1, 13);
      //   $schedule->command('note:send')->hourly();
       //  $schedule->command('send:web')->hourly();

       $schedule->call(function () {
            DB::table('job_description')->whereRaw('job_stop >= see_it')->update(['see_it' => DB::raw('see_it+RAND()*(9-3)+7')]);
        }) //->hourly();
         ->between('9:00', '23:00');

         $schedule->call(function () {
            DB::table('seekers')->update(['see_it' => DB::raw('see_it+RAND()*(4-3)+3')]);
            DB::table('companys')->update(['see_it' => DB::raw('see_it+RAND()*(4-3)+3')]);
        })->twiceDaily(1, 13);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
