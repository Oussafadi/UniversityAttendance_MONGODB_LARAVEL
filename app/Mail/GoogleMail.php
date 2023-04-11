<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GoogleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;
    public $messages;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $messages)
    {
        $this->subject = $subject;
        $this->messages = $messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('student.email')->with('message', "De la part de l'admin de Ghiyabi");
    }
}
