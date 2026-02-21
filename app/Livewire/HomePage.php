<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Event;
use App\Models\Testimonial;
use App\Models\Partner;
use Livewire\Attributes\Title;

class HomePage extends Component
{
    #[Title('Accueil')]
    public function render()
    {
        $latestArticles = Article::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestEvents = Event::where('status', 'published')
            ->with('eventType')
            ->latest('order')
            ->take(3)
            ->get();

        $testimonials = Testimonial::active()
            ->get();

        // Récupérer les partenaires actifs triés par ordre
        $partners = Partner::active()
            ->get();

        return view('livewire.home-page', [
            'articles' => $latestArticles,
            'events' => $latestEvents,
            'testimonials' => $testimonials,
            'partners' => $partners,
        ]);
    }
}
