<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventType;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class EventList extends Component
{
    use WithPagination;

    public $type_id = ''; // Pour filtrer par type (Mariage, Anniversaire...)

    #[Title('Nos Réalisations & Événements')]
    public function render()
    {
        $query = Event::query()
            ->where('status', 'published')
            ->with('eventType') // Optimisation
            ->latest('event_date'); // Du plus récent au plus ancien

        if ($this->type_id) {
            $query->where('event_type_id', $this->type_id);
        }

        return view('livewire.portfolio.event-list', [
            'events' => $query->paginate(9),
            'types' => EventType::where('is_active', true)->get()
        ]);
    }
    
    public function updatedTypeId()
    {
        $this->resetPage();
    }
}