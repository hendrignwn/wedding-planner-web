<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPasswordNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password - ' . config('app.name'))
                ->view('emails.user.forgot-password-notification')
                ->with([
                    'model' =>  $this->user,
        ]);
    }
}
