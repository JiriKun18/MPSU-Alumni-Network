<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'company_name',
        'position_type',
        'location',
        'salary_min',
        'salary_max',
        'requirements',
        'contact_email',
        'contact_phone',
        'contact_website',
        'contact_address',
        'latitude',
        'longitude',
        'approval_status',
        'admin_notes',
        'deadline',
        'is_active',
        'posted_by',
    ];

    protected $dates = ['deadline'];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function applicationCount()
    {
        return $this->applications()->count();
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function isExpired()
    {
        return $this->deadline < now();
    }
}
