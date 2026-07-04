<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Message $contactMessage)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau message de contact reçu - MUDEA',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact.admin',
            with: ['contactMessage' => $this->contactMessage],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
