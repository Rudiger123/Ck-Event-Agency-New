<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Event;
use App\Services\SeoService;
use App\Services\Schemas\SchemaGenerator;
use Livewire\Attributes\Title;

class EventDetail extends Component
{
    public Event $event;

    public function mount($slug)
    {
        $this->event = Event::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Configurer le SEO avec SeoService
        $this->configureSeo();
    }

    private function configureSeo(): void
    {
        $imageUrl = $this->event->getFirstMediaUrl('featured') ?? asset('images/event-default.png');
        $url = route('portfolio.show', $this->event->slug);
        $description = \Illuminate\Support\Str::limit(strip_tags($this->event->description), 160);

        // Configurer les meta tags
        SeoService::for()
            ->setMeta([
                'title' => $this->event->meta_title ?? $this->event->title,
                'description' => $this->event->meta_description ?? $description,
                'keywords' => $this->event->eventType?->name ?? 'événement, luxe',
                'canonical' => $url,
            ])
            ->setOpenGraph([
                'title' => $this->event->meta_title ?? $this->event->title,
                'description' => $this->event->meta_description ?? $description,
                'type' => 'website',
                'url' => $url,
                'image' => $imageUrl,
            ])
            ->setSchema(SchemaGenerator::event($this->event));
    }

    public function render()
    {
        return view('livewire.portfolio.event-detail');
    }
}
