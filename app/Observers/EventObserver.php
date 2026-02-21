<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\NewsletterSubscriber;
use App\Mail\NewEventNotificationMail;
use Illuminate\Support\Facades\Mail;

class EventObserver
{
    /**
     * Notifier les abonnés lorsqu'un événement est publié
     */
    public function updated(Event $event): void
    {
        // Vérifier si l'événement a juste été publié
        if ($event->isDirty('status') && $event->status === 'published') {
            $this->notifySubscribers($event);
        }
    }

    public function created(Event $event): void
    {
        // Si l'événement est créé directement en publié
        if ($event->status === 'published') {
            $this->notifySubscribers($event);
        }
    }

    /**
     * Notifier les abonnés actifs
     */
    private function notifySubscribers(Event $event): void
    {
        // Récupérer les abonnés confirmés par langue
        $subscribers = NewsletterSubscriber::active()
            ->byLocale($event->getLocale() ?? 'fr')
            ->chunk(100);

        foreach ($subscribers as $chunk) {
            foreach ($chunk as $subscriber) {
                Mail::queue(new NewEventNotificationMail($subscriber, $event));
            }
        }
    }
}
