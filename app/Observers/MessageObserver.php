<?php

namespace App\Observers;

use App\Models\Message;
use App\Mail\NewMessageNotificationMail;
use Illuminate\Support\Facades\Mail;

class MessageObserver
{
    /**
     * Envoyer une notification email à l'admin quand un message est créé
     */
    public function created(Message $message): void
    {
        try {
            $adminEmail = config('app.admin_email') ?? 'cynthiankwete@gmail.com';

            Mail::to($adminEmail)
                ->send(new NewMessageNotificationMail($message));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi de notification de message', [
                'error' => $e->getMessage(),
                'message_id' => $message->id,
            ]);
        }
    }

    public function updated(Message $message): void
    {
        //
    }

    public function deleted(Message $message): void
    {
        //
    }

    public function restored(Message $message): void
    {
        //
    }

    public function forceDeleted(Message $message): void
    {
        //
    }
}
