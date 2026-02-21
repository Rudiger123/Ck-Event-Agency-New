<?php

namespace App\Observers;

use App\Models\Comment;
use App\Mail\NewCommentNotificationMail;
use Illuminate\Support\Facades\Mail;

class CommentObserver
{
    /**
     * Envoyer une notification email à l'admin quand un commentaire est créé
     * (Optionnel : il peut être filtré manuellement avant publication)
     */
    public function created(Comment $comment): void
    {
        // Envoyer une notification même si le commentaire n'est pas encore visible
        // Une modération peut être effectuée dans Filament
        try {
            $adminEmail = config('app.admin_email') ?? 'cynthiankwete@gmail.com';

            Mail::to($adminEmail)
                ->send(new NewCommentNotificationMail($comment));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi de notification de commentaire', [
                'error' => $e->getMessage(),
                'comment_id' => $comment->id,
            ]);
        }
    }

    public function updated(Comment $comment): void
    {
        //
    }

    public function deleted(Comment $comment): void
    {
        //
    }

    public function restored(Comment $comment): void
    {
        //
    }

    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
