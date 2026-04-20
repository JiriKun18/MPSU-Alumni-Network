<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'batch_id',
        'student_id',
        'phone',
        'bio',
        'current_position',
        'current_company',
        'profile_picture',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'province',
        'course',
        'linkedin_url',
        'facebook_url',
    ];

    protected $dates = ['date_of_birth'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'alumni_id', 'user_id');
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class, 'alumni_id', 'user_id');
    }
}
