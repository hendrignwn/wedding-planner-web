<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterRequestNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    protected $userRelation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\User $user, App\User $userRelation)
    {
        $this->user = $user;
        $this->userRelation = $userRelation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->userRelation->name . ' telah bergabung di ' . config('app.name') . ' dan memilih Anda sebagai pasangannya - ' . config('app.name'))
                ->view('emails.user.register-request-notification')
                ->with([
                    'model' =>  $this->user,
                    'userRelation' =>  $this->userRelation,
        ]);
    }
}
