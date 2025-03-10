<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ebook_url',
        'youtube_playlist',
        'registration_link',
        'supporting_companies',
        'is_active'
    ];

    protected $casts = [
        'supporting_companies' => 'array',
        'is_active' => 'boolean'
    ];
}
