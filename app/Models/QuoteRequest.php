<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = [
        'reference', 'name', 'email', 'phone', 'company', 
        'service_types', 'event_date', 'location', 'budget', 
        'message', 'status'
    ];

    protected $casts = [
        'service_types' => 'array', // Important pour le JSON
        'event_date' => 'date',
    ];
}