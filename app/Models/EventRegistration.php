<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'event_id',
        'status',
        'additional_info',
    ];

    public function alumni()
    {
        return $this->belongsTo(User::class, 'alumni_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
