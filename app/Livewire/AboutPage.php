<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;
use Livewire\Attributes\Title;

class AboutPage extends Component
{
    #[Title('À Propos de Cynthia')]
   public function render()
    {
        $page = \App\Models\Page::where('key', 'about')->first();
        // On récupère le parcours trié par année décroissante
        $journeys = \App\Models\Journey::orderBy('year', 'desc')->get();

        return view('livewire.about-page', [
            'page' => $page,
            'journeys' => $journeys
        ]);
    }
}