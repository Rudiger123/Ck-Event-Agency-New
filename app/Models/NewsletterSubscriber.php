<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $table = 'newsletter_subscribers';

    protected $fillable = [
        'email',
        'first_name',
        'locale',
        'status',
        'confirmation_token',
        'unsubscribe_token',
        'confirmed_at',
        'unsubscribed_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope : Récupérer les abonnés actifs
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope : Récupérer par langue
     */
    public function scopeByLocale($query, $locale = 'fr')
    {
        return $query->where('locale', $locale);
    }

    /**
     * Marquer comme confirmé
     */
    public function confirm()
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'confirmation_token' => null,
        ]);
    }

    /**
     * Marquer comme désabonné
     */
    public function unsubscribe()
    {
        $this->update([
            'status' => 'unsubscribed',
            'unsubscribed_at' => now(),
        ]);
    }
}
