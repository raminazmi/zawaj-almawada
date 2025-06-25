<?php

namespace App\Http\Controllers;

use App\Models\CourseExam;
use App\Models\CourseExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExamCertificate;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Log;

class CourseExamController extends Controller
{
    /**
     * عرض قائمة الاختبارات المتاحة
     */
    public function index()
    {
        $exams = CourseExam::getActiveExams();
        return view('course-exams.index', compact('exams'));
    }

    /**
     * عرض الاختبار
     */
    public function show(CourseExam $exam)
    {
        if (!$exam->is_active || now() < $exam->start_time || now() > $exam->end_time) {
            return redirect()->route('course-exams.index')
                ->with('error', 'الاختبار غير متاح حالياً');
        }

        $user = auth()->user();
        $result = $exam->results()->where('user_id', $user->id)->first();
        if (!$result) {
            $result = $exam->results()->create([
                'user_id' => $user->id,
                'score' => 0,
                'answers' => json_encode([]),
                'exam_started_at' => now(),
            ]);
        } elseif ($result->exam_started_at && now()->diffInMinutes($result->exam_started_at) > 60) {
            return redirect()->route('course-exams.index')->with('error', 'انتهى وقت الاختبار المخصص لك.');
        }

        $exam->load('questions.options');
        return view('course-exams.show', compact('exam'));
    }

    /**
     * تقديم الإجابات
     */
    public function submit(Request $request, CourseExam $exam)
    {
        try {
            $user = auth()->user();
            $result = $exam->results()->where('user_id', $user->id)->first();
            if (!$result || ($result->exam_started_at && now()->diffInMinutes($result->exam_started_at) > 60)) {
                return redirect()->route('course-exams.index')->with('error', 'انتهى وقت الاختبار المخصص لك.');
            }

            if (!$request->isMethod('post')) {
                return redirect()->route('course-exams.show', $exam)
                    ->with('error', 'يرجى إرسال الإجابات من خلال النموذج');
            }

            $request->validate([
                'answers' => 'required|array',
                'answers.*' => 'string',
            ]);

            $answers = $request->input('answers');
            $earnedPoints = 0; // النقاط المكتسبة
            $totalPoints = 0;  // إجمالي النقاط الممكنة

            // حساب النقاط المكتسبة وإجمالي النقاط
            foreach ($exam->questions as $question) {
                $points = $question->points ?? 1; // النقاط الافتراضية 1 إذا لم يتم تحديدها
                $totalPoints += $points; // إضافة نقاط السؤال إلى الإجمالي

                if (isset($answers[$question->id])) {
                    $userAnswer = trim(strtolower($answers[$question->id])); // تنظيف الإجابة وتحويلها إلى حالة سفلية

                    Log::info("Question ID: {$question->id}, Type: {$question->question_type_id}, User Answer: {$userAnswer}, Correct Answer: {$question->correct_answer}");

                    if ($question->question_type_id == 1) { // اختيار من متعدد
                        $correctOption = $question->options->firstWhere('is_correct', true);
                        if ($correctOption && $userAnswer == trim(strtolower($correctOption->text))) {
                            $earnedPoints += $points;
                        }
                    } elseif ($question->question_type_id == 2) { // صح/خطأ
                        $correctAnswer = trim(strtolower($question->correct_answer));
                        // التأكد من أن correct_answer يحتوي على true أو false
                        if ($correctAnswer === 'true' || $correctAnswer === 'false') {
                            if ($userAnswer === $correctAnswer) {
                                $earnedPoints += $points;
                            }
                        } else {
                            // إذا كان correct_answer لا يحتوي على true/false، قد نحتاج إلى تعديل المنطق
                            Log::warning("Unexpected correct_answer format for question {$question->id}: {$correctAnswer}");
                        }
                    } elseif ($question->question_type_id == 3) { // نص قصير
                        if ($question->correct_answer !== null && $userAnswer == trim(strtolower($question->correct_answer))) {
                            $earnedPoints += $points;
                        }
                    }
                }
            }

            // حساب النسبة المئوية
            $score = $totalPoints > 0 ? ($earnedPoints / $totalPoints) * 100 : 0;

            // حفظ النتيجة
            $result->update([
                'score' => $score,
                'answers' => json_encode($answers),
            ]);
            Log::info('تم تحديث النتيجة بنجاح', ['result_id' => $result->id, 'score' => $score]);

            // محاولة إرسال الشهادة
            try {
                $this->sendCertificate($result);
                Log::info('تم إرسال الشهادة بنجاح', ['email' => $result->user->email]);
            } catch (\Exception $e) {
                Log::error('فشل إرسال الشهادة', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
            }

            return redirect()->route('course-exams.result', $result)
                ->with('success', 'تم تقديم الإجابات بنجاح، وتم إرسال الشهادة إلى بريدك الإلكتروني (إذا كانت متاحة).');
        } catch (\Exception $e) {
            Log::error('خطأ أثناء تقديم الإجابات', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return back()->with('error', 'حدث خطأ أثناء تقديم الإجابات.');
        }
    }

    /**
     * عرض نتيجة الاختبار
     */
    public function result(CourseExamResult $result)
    {
        return view('course-exams.result', compact('result'));
    }

    /**
     * إرسال الشهادة عبر البريد الإلكتروني
     */
    private function sendCertificate($result)
    {
        try {
            $result->loadMissing(['user', 'exam']);

            // Generate HTML
            $html = view('course-exams.certificate', ['result' => $result])->render();

            // Generate filename and path
            $filename = 'certificate_' . uniqid() . '.png';
            $path = storage_path('app/public/certificates/' . $filename);

            // Ensure directory exists
            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            Browsershot::html($html)
                ->setNodeBinary(env('BROWSERSHOT_NODE_PATH', '/usr/bin/node'))
                ->setNpmBinary(env('BROWSERSHOT_NPM_PATH', '/usr/bin/npm')) // إضافة إذا لزم الأمر
                ->setChromePath(env('BROWSERSHOT_CHROME_PATH', '/usr/bin/chromium-browser'))
                ->setOption('args', [ // تمرير الخيارات بشكل صحيح
                    '--no-sandbox',
                    '--disable-setuid-sandbox',
                    '--disable-dev-shm-usage'
                ])
                ->windowSize(920, 860)
                ->timeout(120)
                ->waitUntilNetworkIdle(false)
                ->delay(2000) // زيادة وقت التأخير
                ->save($path);

            // Send email
            Mail::to($result->user->email)->send(new ExamCertificate($result, $path));

            $result->update(['certificate_sent' => true]);
        } catch (\Exception $e) {
            Log::error('Certificate generation failed', [
                'result_id' => $result->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * إعادة إرسال الشهادة
     */
    public function resendCertificate(CourseExamResult $result)
    {
        try {
            $this->sendCertificate($result);
            return back()->with('success', 'تمت إعادة إرسال الشهادة بنجاح');
        } catch (\Exception $e) {
            Log::error('خطأ أثناء إعادة إرسال الشهادة', ['message' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء إعادة إرسال الشهادة.');
        }
    }

    /**
     * تنزيل الشهادة كصورة PNG
     */
    protected function generateBrowsershotCertificate(CourseExamResult $result)
    {
        $result->loadMissing(['user', 'exam']);
        $html = view('course-exams.certificate', ['result' => $result])->render();

        $filename = 'certificate_' . uniqid() . '.png';
        $path = storage_path("app/public/certificates/{$filename}");

        // Ensure directory exists
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        Browsershot::html($html)
            ->setNodeBinary(env('BROWSERSHOT_NODE_PATH', '/usr/bin/node'))
            ->setNpmBinary(env('BROWSERSHOT_NPM_PATH', '/usr/bin/npm'))
            ->setChromePath(env('BROWSERSHOT_CHROME_PATH', '/usr/bin/chromium-browser'))
            ->setOption('args', [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-dev-shm-usage',
                '--single-process'
            ])
            ->windowSize(920, 860)
            ->timeout(300) // زيادة المهلة
            ->waitUntilNetworkIdle()
            ->delay(10000) // تأخير أطول للتصيير
            ->save($path);

        return $path;
    }

    public function downloadCertificate(CourseExamResult $result)
    {
        try {
            $path = $this->generateBrowsershotCertificate($result);

            if (!file_exists($path)) {
                throw new \Exception('Failed to generate certificate file');
            }

            return response()->download($path)
                ->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Certificate download failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'فشل توليد الشهادة: ' . $e->getMessage());
        }
    }
}
