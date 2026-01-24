<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message; // Assure-toi que ce modèle existe
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

class ContactPage extends Component
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $subject = '';

    #[Validate('required|min:10')]
    public $message = '';

    public $successMessage = '';

    #[Title('Contactez-nous')]
    public function render()
    {
        return view('livewire.contact-page');
    }

    public function submit()
    {
        $this->validate();

        // Sauvegarde dans la base de données
        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'status' => 'unread',
        ]);

        // Reset du formulaire
        $this->reset(['name', 'email', 'subject', 'message']);

        // Message de succès
        $this->successMessage = "Merci ! Votre message a bien été envoyé. Cynthia vous répondra très bientôt.";
    }
}