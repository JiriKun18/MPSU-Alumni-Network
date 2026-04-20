<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function alumniProfile()
    {
        return $this->hasOne(AlumniProfile::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'alumni_id');
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class, 'alumni_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function postedJobs()
    {
        return $this->hasMany(JobPosting::class, 'posted_by');
    }

    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function createdNews()
    {
        return $this->hasMany(News::class, 'posted_by');
    }

    public function isAlumni()
    {
        return $this->role === 'alumni';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getUnreadNotificationsCount()
    {
        return $this->notifications()->where('is_read', false)->count();
    }

    public function getUnreadMessagesCount()
    {
        return $this->receivedMessages()->where('is_read', false)->count();
    }
}
