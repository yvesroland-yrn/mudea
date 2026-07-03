<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Message $message)
    {
    }

    public function build(): self
    {
        return $this->subject('Nous avons bien reçu votre message - MUDEA')
            ->view('emails.contact.user')
            ->with(['message' => $this->message]);
    }
}
