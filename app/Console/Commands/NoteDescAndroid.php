<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\AndroidHelpers;
class NoteDescAndroid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'note:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description android send note';

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
     * @return mixed
     */
    public function handle()
    {

        // AndroidHelpers::FireBaseStateJob();
         AndroidHelpers::FireBaseStateJobs();
       // Log::info("NoteDesc Android is Work");
    }
}
