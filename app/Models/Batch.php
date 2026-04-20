<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'description', 'notes'];

    public function alumniProfiles()
    {
        return $this->hasMany(AlumniProfile::class);
    }

    public function alumniCount()
    {
        return $this->alumniProfiles()->count();
    }
}
