<?php

namespace App\Jobs;

use App\Seeker;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EmailPasswordResetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $timeout = 20;
    public $tries = 2;


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


        Mail::send('seekers.auth.emails.password', [
            'token' => $req->remember_token,
            'email' =>  $req->email
        ], function ($m){
            // $m->from($this->seeker->email, 'Lara Job');
            $m->to($this->seeker->email,'Libya Cv - ليبيا لتوظيف')->subject('أستعادة كلمة السر');
        });
    }
}
