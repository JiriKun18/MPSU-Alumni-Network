<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'job_posting_id',
        'cover_letter',
        'cv_file',
        'status',
        'admin_notes',
    ];

    public function alumni()
    {
        return $this->belongsTo(User::class, 'alumni_id');
    }

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }

    public function profile()
    {
        return $this->alumni->alumniProfile();
    }
}
