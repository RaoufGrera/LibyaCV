<?php

namespace App\Console\Commands;

use App\MainHelper;
use App\Helpers;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RefreshWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        MainHelper::RefreshWebsite();
        Helpers::ManageRedis('CreateRedis');
     //   Log::info("Refresh Website is Work");
    }
}
