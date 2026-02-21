<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewQuoteRequestNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quoteRequest)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "💼 Nouvelle demande de devis - Réf: {$this->quoteRequest->reference}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-notification-quote',
            with: [
                'quoteRequest' => $this->quoteRequest,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
