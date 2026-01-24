<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class QuoteReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $messageText;
    public $attachmentPath;

    public function __construct($subjectText, $messageText, $attachmentPath = null)
    {
        $this->subjectText = $subjectText;
        $this->messageText = $messageText;
        $this->attachmentPath = $attachmentPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quote-reply', // On va créer cette vue juste après
        );
    }

    public function attachments(): array
    {
        if ($this->attachmentPath) {
            return [
                Attachment::fromStorageDisk('public', $this->attachmentPath),
            ];
        }
        return [];
    }
}