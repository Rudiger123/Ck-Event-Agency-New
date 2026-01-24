<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status', // unread, read, replied
        'type',   // general, devis, etc.
        'admin_notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}