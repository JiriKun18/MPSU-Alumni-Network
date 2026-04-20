<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'featured_image',
        'is_published',
        'published_at',
        'posted_by',
    ];

    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function getExcerpt($length = 150)
    {
        return substr(strip_tags($this->content), 0, $length) . '...';
    }
}
