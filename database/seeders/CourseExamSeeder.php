<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseExam;
use App\Models\CourseExamQuestion;

class CourseExamSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء اختبار جديد
        $exam = CourseExam::create([
            'title' => 'اختبار التأهيل للحياة الزوجية',
            'description' => 'اختبار مكون من عدة أسئلة لقياس مدى الاستفادة من الدورة.',
            'duration' => 30, // بالدقائق
            'start_time' => now()->subDay(),
            'end_time' => now()->addMonth(),
            'is_active' => true,
        ]);

        // إضافة أسئلة للاختبار
        $questions = [
            [
                'question' => 'ما هو أهم عنصر في العلاقة الزوجية الناجحة؟',
                'options' => ['الحب', 'الاحترام', 'المال', 'الجمال'],
                'correct_answer' => 'الاحترام',
                'points' => 1,
            ],
            [
                'question' => 'كم عدد أركان الزواج في الإسلام؟',
                'options' => ['2', '3', '4', '5'],
                'correct_answer' => '3',
                'points' => 1,
            ],
            [
                'question' => 'ما هو السن الأنسب للزواج؟',
                'options' => ['18', '20', '25', 'يختلف حسب الظروف'],
                'correct_answer' => 'يختلف حسب الظروف',
                'points' => 1,
            ],
        ];

        foreach ($questions as $q) {
            CourseExamQuestion::create([
                'course_exam_id' => $exam->id,
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_answer' => $q['correct_answer'],
                'points' => $q['points'],
            ]);
        }
    }
}