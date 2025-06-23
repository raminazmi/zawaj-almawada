<?php

namespace App\Http\Controllers;

use App\Models\CourseExam;
use App\Models\CourseExamQuestion;
use App\Models\CourseExamResult;
use Illuminate\Http\Request;
use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExamCertificate;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class CourseExamController extends Controller
{
    public function index()
    {
        $exams = CourseExam::with('questions')->get();
        return view('course-exams.index', compact('exams'));
    }

    public function create()
    {
        return view('course-exams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'is_active' => 'boolean',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.correct_answer' => 'required|string',
            'questions.*.points' => 'required|integer|min:1',
        ]);

        $exam = CourseExam::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'is_active' => $validated['is_active'] ?? false,
        ]);

        foreach ($validated['questions'] as $questionData) {
            $exam->questions()->create([
                'question' => $questionData['question'],
                'options' => $questionData['options'],
                'correct_answer' => $questionData['correct_answer'],
                'points' => $questionData['points'],
            ]);
        }

        return redirect()->route('admin.exams.index')
            ->with('success', 'تم إنشاء الاختبار بنجاح');
    }

    public function edit(CourseExam $exam)
    {
        return view('course-exams.edit', compact('exam'));
    }

    public function update(Request $request, CourseExam $exam)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'is_active' => 'boolean',
        ]);

        $exam->update($validated);

        return redirect()->route('admin.exams.index')
            ->with('success', 'تم تحديث الاختبار بنجاح');
    }

    public function destroy(CourseExam $exam)
    {
        $exam->delete();
        return redirect()->route('admin.exams.index')
            ->with('success', 'تم حذف الاختبار بنجاح');
    }

    public function results(CourseExam $exam)
    {
        $results = $exam->results()->with('user')->get();
        return view('course-exams.results', compact('exam', 'results'));
    }

    public function show(CourseExam $exam)
    {
        if (!$exam->is_active || now() < $exam->start_time || now() > $exam->end_time) {
            return redirect()->route('course-exams.index')
                ->with('error', 'الاختبار غير متاح حالياً');
        }

        return view('course-exams.show', compact('exam'));
    }

    public function submit(Request $request, CourseExam $exam)
    {
        // التحقق من أن الطلب هو POST
        if (!$request->isMethod('post')) {
            return redirect()->route('course-exams.show', $exam)
                ->with('error', 'يرجى إرسال الإجابات من خلال النموذج');
        }

        // التحقق من وجود الإجابات
        if (!$request->has('answers')) {
            return redirect()->route('course-exams.show', $exam)
                ->with('error', 'يرجى الإجابة على جميع الأسئلة');
        }

        $answers = $request->input('answers');
        $score = 0;

        foreach ($exam->questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] == $question->correct_answer) {
                $score += $question->points;
            }
        }

        $result = CourseExamResult::create([
            'course_exam_id' => $exam->id,
            'user_id' => auth()->id(),
            'score' => $score,
            'answers' => $answers
        ]);

        // تحميل العلاقات المطلوبة
        $result->load(['user', 'exam']);

        // إرسال الشهادة بالبريد الإلكتروني
        $this->sendCertificate($result);

        return redirect()->route('course-exams.result', $result)
            ->with('success', 'تم إرسال الشهادة إلى بريدك الإلكتروني');
    }

    public function result(CourseExamResult $result)
    {
        return view('course-exams.result', compact('result'));
    }

    private function sendCertificate($result)
    {
        // تحميل العلاقات
        $result->loadMissing(['user', 'exam']);

        // توليد HTML الشهادة
        $html = view('course-exams.certificate', [
            'result' => $result,
            'title' => 'شهادة إتمام الاختبار'
        ])->render();

        // توليد اسم عشوائي للصورة
        $filename = 'certificate_' . uniqid() . '.png';
        $path = storage_path('app/public/certificates/' . $filename);

        // توليد الصورة من الـ HTML
        Browsershot::html($html)
            ->setNodeBinary('node') // أو المسار الكامل إذا لم يكن في PATH
            ->windowSize(900, 720)
            ->waitUntilNetworkIdle()
            ->save($path);

        // إرسال البريد مع الصورة كمرفق
        Mail::to($result->user->email)->send(new ExamCertificate($result, $path));

        // حذف الصورة بعد الإرسال إذا أردت
        // unlink($path);

        $result->update(['certificate_sent' => true]);
    }

    public function resendCertificate(CourseExamResult $result)
    {
        $this->sendCertificate($result);
        return back()->with('success', 'تمت إعادة إرسال الشهادة بنجاح');
    }

    public function showCertificate(CourseExamResult $result)
    {
        try {
            // التأكد من تحميل العلاقات
            if (!$result->relationLoaded('user')) {
                $result->load('user');
            }
            if (!$result->relationLoaded('exam')) {
                $result->load('exam');
            }

            $defaultConfig = config('gpdf');
            $config = new GpdfConfig($defaultConfig);
            $gpdf = new Gpdf($config);

            $html = view('course-exams.certificate', [
                'result' => $result,
                'title' => 'شهادة إتمام الاختبار'
            ])->render();

            $pdfContent = $gpdf->generate($html);

            // تغيير طريقة عرض PDF
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="certificate.pdf"')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء إنشاء الشهادة: ' . $e->getMessage());
        }
    }
}