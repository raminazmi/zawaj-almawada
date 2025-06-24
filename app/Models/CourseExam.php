<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class CourseExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'start_time',
        'end_time',
        'is_active'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean'
    ];

    /**
     * العلاقة مع الأسئلة باستخدام التخزين المؤقت لتحسين الأداء
     */
    public function questions()
    {
        return $this->hasMany(CourseExamQuestion::class);
    }

    /**
     * العلاقة مع النتائج
     */
    public function results()
    {
        return $this->hasMany(CourseExamResult::class);
    }

    /**
     * جلب الاختبارات مع التخزين المؤقت
     */
    public static function getActiveExams()
    {
        return Cache::remember('active_exams', 60 * 60, function () {
            return self::where('is_active', true)
                ->where('start_time', '<=', now())
                ->where('end_time', '>=', now())
                ->with('questions.options') // تحميل العلاقات مسبقًا
                ->get();
        });
    }
}