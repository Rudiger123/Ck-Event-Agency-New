<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Newsletter extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'user_id',
        'subject',
        'content',
        'status',
        'sent_at',
    ];

    // Les colonnes traduisibles (JSON)
    public $translatable = [
        'subject',
        'content',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation : Utilisateur qui a créé la newsletter
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope : Récupérer les newsletters envoyées
     */
    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    /**
     * Scope : Récupérer les brouillons
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
