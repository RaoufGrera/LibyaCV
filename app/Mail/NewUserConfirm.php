<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Seeker;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $seeker;

    public function __construct($seeker)
    {
        $this->seeker = $seeker;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user.newuserconfirm')->with([
            'email_token' => $this->seeker->confirmation_code,
        ]);


        //return $this->markdown('emails.user.newuserconfirm');
    }
}
