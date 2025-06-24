<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseExamResult extends Model
{
    protected $fillable = [
        'course_exam_id',
        'user_id',
        'score',
        'answers',
        'certificate_sent',
        'exam_started_at',
    ];

    protected $casts = [
        'answers' => 'array',
        'certificate_sent' => 'boolean',
        'exam_started_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(CourseExam::class, 'course_exam_id');
    }
}
