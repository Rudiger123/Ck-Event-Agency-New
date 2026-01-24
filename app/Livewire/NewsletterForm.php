<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber; // Assure-toi que ce modèle existe
use Livewire\Attributes\Validate;

class NewsletterForm extends Component
{
    #[Validate('required|email|unique:newsletter_subscribers,email')]
    public $email = '';

    public $subscribed = false;

    public function subscribe()
    {
        $this->validate();

        NewsletterSubscriber::create([
            'email' => $this->email,
            'status' => 'confirmed', // On simplifie pour l'instant
            'locale' => app()->getLocale(),
            'created_at' => now(),
        ]);

        $this->subscribed = true;
        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}