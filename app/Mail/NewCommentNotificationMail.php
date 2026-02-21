<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCommentNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Comment $comment)
    {
    }

    public function envelope(): Envelope
    {
        $title = $this->comment->article?->title ?? $this->comment->event?->title ?? 'Nouveau contenu';

        return new Envelope(
            subject: "💬 Nouveau commentaire sur : \"{$title}\"",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-notification-comment',
            with: [
                'comment' => $this->comment,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
