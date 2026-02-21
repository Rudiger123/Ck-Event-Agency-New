<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewMessageNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Message $message)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "🔔 Nouveau message de contact : {$this->message->name}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-notification-message',
            with: [
                'msg' => $this->message,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
