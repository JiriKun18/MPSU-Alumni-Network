<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'venue',
        'event_date',
        'event_time',
        'max_attendees',
        'status',
        'image',
        'created_by',
    ];

    protected $dates = ['event_date'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function registrationCount()
    {
        return $this->registrations()->where('status', '!=', 'cancelled')->count();
    }

    public function isExpired()
    {
        return $this->event_date < now();
    }

    public function isFull()
    {
        return $this->max_attendees && $this->registrationCount() >= $this->max_attendees;
    }
}
