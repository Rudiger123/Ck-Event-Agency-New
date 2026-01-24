<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Event;
use Livewire\Attributes\Title;

class HomePage extends Component
{
    #[Title('Accueil')] 
    public function render()
    {
        // ... (tes autres requêtes articles/events) ...
        $latestArticles = \App\Models\Article::where('status', 'published')->latest('published_at')->take(3)->get();
        $latestEvents = \App\Models\Event::where('status', 'published')->with('eventType')->latest('order')->take(3)->get();

        // AJOUT : Récupérer les témoignages actifs
        $testimonials = \App\Models\Testimonial::where('is_active', true)->latest()->get();

        return view('livewire.home-page', [
            'articles' => $latestArticles,
            'events' => $latestEvents,
            'testimonials' => $testimonials, // <--- On passe la variable ici
        ]);
    }
}