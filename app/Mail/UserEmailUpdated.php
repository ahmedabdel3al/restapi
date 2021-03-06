<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public  $user ;
    public function __construct(User $user)
    {
        $this->user = $user ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.updated')->subject('please verify your new account');
    }
}
