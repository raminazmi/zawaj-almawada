<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseExamQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_exam_question_id',
        'text',
        'is_correct',
    ];

    public function question()
    {
        return $this->belongsTo(CourseExamQuestion::class);
    }
}
