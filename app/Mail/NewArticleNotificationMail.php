<?php

namespace App\Mail;

use App\Models\Article;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewArticleNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public NewsletterSubscriber $subscriber,
        public Article $article
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Nouvel article: :title', ['title' => $this->article->title], $this->subscriber->locale),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-article-notification',
            with: [
                'article' => $this->article,
                'subscriber' => $this->subscriber,
                'unsubscribeUrl' => route('newsletter.unsubscribe', [
                    'token' => $this->subscriber->unsubscribe_token,
                ]),
                'articleUrl' => route('articles.show', [
                    'slug' => $this->article->slug,
                ]),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
