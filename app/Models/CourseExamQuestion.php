<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_exam_id',
        'text',
        'type_id',
    ];

    protected $casts = [
        // 'options' => 'array', // احذف هذا السطر، الخيارات أصبحت مودل منفصل
    ];

    public function type()
    {
        // تصحيح المفتاح الخارجي للعلاقة
        return $this->belongsTo(QuestionType::class, 'type_id');
    }

    public function options()
    {
        return $this->hasMany(CourseExamQuestionOption::class);
    }
}
