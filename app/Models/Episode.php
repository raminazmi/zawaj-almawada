<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'episode_number',
        'title',
        'url'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
