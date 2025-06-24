<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    protected $fillable = ['name'];

    /**
     * العلاقة مع الأسئلة
     */
    public function questions()
    {
        return $this->hasMany(CourseExamQuestion::class, 'question_type_id');
    }
}