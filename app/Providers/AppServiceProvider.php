<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message;
use App\Models\QuoteRequest;
use App\Models\Comment;
use App\Observers\MessageObserver;
use App\Observers\QuoteRequestObserver;
use App\Observers\CommentObserver;
use App\Services\SeoService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Enregistrer SeoService comme singleton
        $this->app->singleton(SeoService::class, fn () => new SeoService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enregistrer la namespace mail pour les composants email
        View::addNamespace('mail', resource_path('views/vendor/mail'));

        // Enregistrer les Observers pour les notifications email automatiques
        Message::observe(MessageObserver::class);
        QuoteRequest::observe(QuoteRequestObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
