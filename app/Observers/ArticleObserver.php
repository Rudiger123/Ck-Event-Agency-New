<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\NewsletterSubscriber;
use App\Mail\NewArticleNotificationMail;
use Illuminate\Support\Facades\Mail;

class ArticleObserver
{
    /**
     * Notifier les abonnés lorsqu'un article est publié
     */
    public function updated(Article $article): void
    {
        // Vérifier si l'article a juste été publié
        if ($article->isDirty('status') && $article->status === 'published' && $article->published_at) {
            $this->notifySubscribers($article);
        }
    }

    public function created(Article $article): void
    {
        // Si l'article est créé directement en publié
        if ($article->status === 'published' && $article->published_at) {
            $this->notifySubscribers($article);
        }
    }

    /**
     * Notifier les abonnés actifs
     */
    private function notifySubscribers(Article $article): void
    {
        // ✅ CORRECT : Utiliser chunk() avec un callback
        NewsletterSubscriber::active()
            ->byLocale($article->getLocale() ?? 'fr')
            ->chunk(100, function ($subscribers) use ($article) {
                foreach ($subscribers as $subscriber) {
                    Mail::send(new NewArticleNotificationMail($subscriber, $article));
                }
            });
    }
}
