<?php

namespace App\Observers;

use App\Models\QuoteRequest;
use App\Mail\NewQuoteRequestNotificationMail;
use Illuminate\Support\Facades\Mail;

class QuoteRequestObserver
{
    /**
     * Envoyer une notification email à l'admin quand une demande de devis est créée
     */
    public function created(QuoteRequest $quoteRequest): void
    {
        try {
            $adminEmail = config('app.admin_email') ?? 'cynthiankwete@gmail.com';

            Mail::to($adminEmail)
                ->send(new NewQuoteRequestNotificationMail($quoteRequest));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi de notification de devis', [
                'error' => $e->getMessage(),
                'quote_request_id' => $quoteRequest->id,
            ]);
        }
    }

    public function updated(QuoteRequest $quoteRequest): void
    {
        //
    }

    public function deleted(QuoteRequest $quoteRequest): void
    {
        //
    }

    public function restored(QuoteRequest $quoteRequest): void
    {
        //
    }

    public function forceDeleted(QuoteRequest $quoteRequest): void
    {
        //
    }
}
