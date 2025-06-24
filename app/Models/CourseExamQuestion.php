<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_exam_id',
        'question',
        'question_type_id',
        'correct_answer'
    ];

    /**
     * العلاقة مع نوع السؤال
     */
    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }

    /**
     * العلاقة مع الخيارات
     */
    public function options()
    {
        return $this->hasMany(CourseExamQuestionOption::class);
    }
}