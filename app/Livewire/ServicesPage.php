<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;
use Livewire\Attributes\Title;

class ServicesPage extends Component
{
    #[Title('Nos Services')]
    public function render()
    {
        $page = Page::where('key', 'services')->first();

        return view('livewire.services-page', [
            'page' => $page
        ]);
    }
}