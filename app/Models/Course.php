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
        'course_description',
        'ebook_url',
        'registration_link',
        'supporting_companies',
        'intro_video',
        'course_exam_id',
        'exam_date',
        'exam_time',
        'start_date',
        'end_date',
        'honor_students',
        'is_active'
    ];

    protected $casts = [
        'supporting_companies' => 'array',
        'honor_students' => 'array',
        'is_active' => 'boolean',
        'exam_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function courseExam()
    {
        return $this->belongsTo(CourseExam::class, 'course_exam_id');
    }
}
