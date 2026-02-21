<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\AboutPage;
use App\Livewire\ServicesPage;
use App\Livewire\ContactPage;
use App\Livewire\Blog\ArticleList;
use App\Livewire\Blog\ArticleDetail;
use App\Livewire\Portfolio\EventList;
use App\Livewire\Portfolio\EventDetail;
use Illuminate\Support\Facades\Session;
use App\Livewire\QuoteRequestPage;
use App\Livewire\StaticPage;

// Route pour changer la langue (ex: /lang/en)
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'en'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back(); // Revient à la page précédente
})->name('switch-language');

// Newsletter
Route::get('/newsletter/unsubscribe/{token}', function ($token) {
    $subscriber = \App\Models\NewsletterSubscriber::where('unsubscribe_token', $token)->first();

    if (!$subscriber) {
        return response()->view('errors.404', [], 404);
    }

    $subscriber->update([
        'status' => 'unsubscribed',
        'unsubscribed_at' => now(),
    ]);

    return redirect('/')->with('success', 'Vous avez été désabonné de notre newsletter.');
})->name('newsletter.unsubscribe');

// Page d'Accueil
Route::get('/', HomePage::class)->name('home');

// Pages Statiques
Route::get('/about', AboutPage::class)->name('about');
Route::get('/services', ServicesPage::class)->name('services');
Route::get('/contact', ContactPage::class)->name('contact');

// Blog / Actualités
Route::get('/blog', ArticleList::class)->name('blog.index');
Route::get('/blog/{slug}', ArticleDetail::class)->name('blog.show');

// Portfolio / Événements
Route::get('/portfolio', EventList::class)->name('portfolio.index');
Route::get('/portfolio/{slug}', EventDetail::class)->name('portfolio.show');

// Demander un Devis
Route::get('/devis', QuoteRequestPage::class)->name('quote');

// Route générique pour les pages statiques (ex: /mentions-legales)
Route::get('/{slug}', StaticPage::class)->name('page.show');
