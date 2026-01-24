<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\QuoteRequest;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

class QuoteRequestPage extends Component
{
    // Étape 1 : Infos Perso
    #[Validate('required|min:3')]
    public $name = '';
    
    #[Validate('required|email')]
    public $email = '';
    
    #[Validate('required')]
    public $phone = '';
    
    public $company = '';

    // Étape 2 : Projet
    #[Validate('required|array|min:1')]
    public $service_types = []; // Checkbox multiples

    public $event_date = '';
    public $budget = '';
    
    #[Validate('required|min:20')]
    public $message = '';

    public $success = false;

    public function submit()
    {
        $this->validate();

        QuoteRequest::create([
            'reference' => 'QR-' . strtoupper(uniqid()),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'service_types' => $this->service_types, // Cast automatique en JSON par Laravel
            'event_date' => $this->event_date ?: null,
            'budget' => $this->budget,
            'message' => $this->message,
            'status' => 'new',
        ]);

        $this->success = true;
        $this->reset();
    }

    #[Title('Demander un Devis')]
    public function render()
    {
        return view('livewire.quote-request-page');
    }
}