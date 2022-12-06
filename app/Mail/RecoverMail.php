<?php

namespace App\Mail;

use App\Models\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Users
     */
    protected $user;

    /**
     * @param Users $user
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dukrl222@hotmail.com', 'Eduardo da Silva')
            ->view('mail.recover');
    }
}
