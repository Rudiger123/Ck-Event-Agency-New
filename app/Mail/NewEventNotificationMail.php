<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewEventNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public NewsletterSubscriber $subscriber,
        public Event $event
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Nouvel événement: :title', ['title' => $this->event->title], $this->subscriber->locale),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-event-notification',
            with: [
                'event' => $this->event,
                'subscriber' => $this->subscriber,
                'unsubscribeUrl' => route('newsletter.unsubscribe', [
                    'token' => $this->subscriber->unsubscribe_token,
                ]),
                'eventUrl' => route('events.show', [
                    'slug' => $this->event->slug,
                ]),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
