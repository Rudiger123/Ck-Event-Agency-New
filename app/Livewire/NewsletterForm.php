<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class NewsletterForm extends Component
{
    #[Validate('required|email|unique:newsletter_subscribers,email')]
    public $email = '';

    #[Validate('nullable|string|max:50')]
    public $first_name = '';

    public $subscribed = false;
    public $message = '';

    public function subscribe()
    {
        $this->validate();

        try {
            // Créer un nouvel abonné avec tokens de confirmation/désabonnement
            NewsletterSubscriber::create([
                'email' => $this->email,
                'first_name' => $this->first_name ?: null,
                'status' => 'confirmed', // Direct confirmation en prod (optionnel : 'pending' avec email de confirmation)
                'locale' => app()->getLocale(),
                'confirmation_token' => Str::random(64),
                'unsubscribe_token' => Str::random(64),
                'confirmed_at' => now(),
            ]);

            $this->subscribed = true;
            $this->message = 'Merci de votre abonnement !';
            $this->reset('email', 'first_name');

            // Dispatch un événement pour notification utilisateur
            $this->dispatch('newsletter-subscribed');
        } catch (\Exception $e) {
            $this->addError('email', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
