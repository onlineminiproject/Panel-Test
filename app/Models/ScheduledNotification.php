<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'data',
        'topic',
        'scheduled_at',
        'sent_at',
    ];

    protected $dates = [
        'scheduled_at',
        'sent_at',
    ];

}
