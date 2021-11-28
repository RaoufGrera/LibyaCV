<?php

namespace App\Jobs;

use App\Mail\NewUserConfirm;
use App\Seeker;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */


    public $timeout = 30;
    public $tries = 3;


    protected $seeker;
    public function __construct(Seeker $seeker)
    {
        $this->seeker = $seeker;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

         $req = $this->seeker;
        Mail::send('seekers.auth.emails.verify', ['confirmation_code' => $this->seeker->confirmation_code], function ($m){

            $m->to($this->seeker->email)->subject('تفعيل الحساب');
        });
    }
}
/*
 *
 <?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\NewUserConfirm;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;





public function handle()
{
    $email = new NewUserConfirm($this->seeker);
public function __construct($seeker)
{

    $this->seeker = $seeker;

}
    Mail::to($this->seeker->email)->send($email);

}
}

private $seeker


*/