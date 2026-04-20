<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'text',
        'type',
        'is_required',
        'position',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function options()
    {
        return $this->hasMany(SurveyOption::class);
    }

    public function answers()
    {
        return $this->hasManyThrough(SurveyAnswer::class, SurveyResponse::class, 'survey_id', 'question_id');
    }
}
