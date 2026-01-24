<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    // On autorise l'enregistrement de ces données
    protected $fillable = [
        'email',
        'status', // 'pending' ou 'confirmed'
        'locale', // 'fr' ou 'en'
        'first_name',
        'confirmation_token',
        'unsubscribe_token'
    ];
}