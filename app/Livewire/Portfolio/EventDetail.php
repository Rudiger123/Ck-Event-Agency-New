<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Event;
use Livewire\Attributes\Title;

class EventDetail extends Component
{
    public Event $event;

    public function mount($slug)
    {
        $this->event = Event::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
    }

    public function render()
    {
        $seoTitle = $this->event->meta_title ?: $this->event->title;
        $seoDesc = $this->event->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($this->event->description), 150);
        $seoImage = $this->event->getFirstMediaUrl('cover_image');

        return view('livewire.portfolio.event-detail')
            ->layout('components.layouts.app', [
                'title' => $seoTitle,
                'description' => $seoDesc,
                'image' => $seoImage,
            ]);
    }
}