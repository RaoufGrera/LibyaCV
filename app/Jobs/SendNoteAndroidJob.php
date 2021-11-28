<?php

namespace App\Jobs;

use App\AndroidHelpers;
use app\Helpers;
use App\SeekerPrice;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendNoteAndroidJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $timeout = 40;
    public $tries = 3;

    protected $seeker_price;

    public function __construct(SeekerPrice $seeker_price)
    {
        $this->seeker_price = $seeker_price;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $obj = $this->seeker_price;
         $seeker_id = $obj->seeker_id;

         AndroidHelpers::FireBaseUpdatePrice($seeker_id);

      //  Log::info("NoteDesc jobs Android is Work");

    }
}
