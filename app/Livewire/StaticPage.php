<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;

class StaticPage extends Component
{
    public Page $page;

    public function mount($slug)
    {
        // On cherche la page par son slug (URL) et on vérifie qu'elle est active
        $this->page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.static-page')
            ->layout('components.layouts.app', [
                'title' => $this->page->meta_title ?: $this->page->title,
                'description' => $this->page->meta_description,
            ]);
    }
}