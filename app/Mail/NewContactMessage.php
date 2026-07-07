<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Message $contactMessage)
    {
    }

    public function build(): self
    {
        return $this->subject('Nouveau message de contact reçu - MUDEA')
            ->view('emails.contact.admin')
            ->with(['contactMessage' => $this->contactMessage]);
    }
}
