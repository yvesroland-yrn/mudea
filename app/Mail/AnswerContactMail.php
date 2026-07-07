<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnswerContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $recipientName;
    public string $replyText;
    public string $mailSubject;
    public array $attachmentNames;
    public array $attachmentPaths;

    /**
     * Create a new message instance.
     */
    public function __construct(string $recipientName, string $replyText, string $mailSubject, array $attachmentNames = [], array $attachmentPaths = [])
    {
        $this->recipientName = $recipientName;
        $this->replyText = $replyText;
        $this->mailSubject = $mailSubject;
        $this->attachmentNames = $attachmentNames;
        $this->attachmentPaths = $attachmentPaths;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact.answer',
            with: [
                'nom' => $this->recipientName,
                'reply' => $this->replyText,
                'subject' => $this->mailSubject,
                'attachments' => $this->attachmentNames,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        foreach ($this->attachmentPaths as $path) {
            if (file_exists($path)) {
                $attachments[] = Attachment::fromPath($path);
            }
        }
        return $attachments;
    }
}
