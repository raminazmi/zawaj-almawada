<?php

namespace App\Http\Controllers;

use App\Models\CourseExam;
use App\Models\CourseExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExamCertificate;
use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;
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
            Log::info('User authenticated', ['user_id' => $user->id, 'exam_id' => $exam->id]);

            $result = $exam->results()->where('user_id', $user->id)->first();
            Log::info('Result fetched', ['result_id' => $result ? $result->id : null, 'exam_started_at' => $result ? $result->exam_started_at : null]);

            if (!$result || ($result->exam_started_at && now()->diffInMinutes($result->exam_started_at) > 60)) {
                Log::warning('Exam time exceeded or no result found', ['user_id' => $user->id, 'exam_id' => $exam->id]);
                return redirect()->route('course-exams.index')->with('error', 'انتهى وقت الاختبار المخصص لك.');
            }

            if (!$request->isMethod('post')) {
                Log::warning('Invalid request method', ['method' => $request->method(), 'exam_id' => $exam->id]);
                return redirect()->route('course-exams.show', $exam)
                    ->with('error', 'يرجى إرسال الإجابات من خلال النموذج');
            }

            $request->validate([
                'answers' => 'required|array',
                'answers.*' => 'string',
            ]);
            Log::info('Validation passed', ['answers_count' => count($request->input('answers'))]);

            $answers = $request->input('answers');
            $earnedPoints = 0;
            $totalPoints = 0;

            foreach ($exam->questions as $question) {
                $points = $question->points ?? 1;
                $totalPoints += $points;

                if (isset($answers[$question->id])) {
                    $userAnswer = trim(strtolower($answers[$question->id]));
                    Log::debug('Processing question', ['question_id' => $question->id, 'user_answer' => $userAnswer]);

                    if ($question->question_type_id == 1) {
                        $correctOption = $question->options->firstWhere('is_correct', true);
                        if ($correctOption && $userAnswer == trim(strtolower($correctOption->text))) {
                            $earnedPoints += $points;
                            Log::debug('Correct answer for multiple choice', ['question_id' => $question->id, 'points' => $points]);
                        }
                    } elseif ($question->question_type_id == 2) {
                        $correctAnswer = trim(strtolower($question->correct_answer));
                        if ($correctAnswer === 'true' || $correctAnswer === 'false') {
                            if ($userAnswer === $correctAnswer) {
                                $earnedPoints += $points;
                                Log::debug('Correct answer for true/false', ['question_id' => $question->id, 'points' => $points]);
                            }
                        }
                    } elseif ($question->question_type_id == 3) {
                        if ($question->correct_answer !== null) {
                            $correctAnswer = trim(strtolower($question->correct_answer));
                            $similarity = 0;
                            similar_text($userAnswer, $correctAnswer, $similarity);
                            if ($similarity >= 90) {
                                $earnedPoints += $points;
                                Log::debug('Correct answer for open-ended (similarity)', [
                                    'question_id' => $question->id,
                                    'points' => $points,
                                    'similarity' => $similarity
                                ]);
                            }
                        }
                    }
                }
            }

            $score = $totalPoints > 0 ? ($earnedPoints / $totalPoints) * 100 : 0;
            Log::info('Score calculated', ['earned_points' => $earnedPoints, 'total_points' => $totalPoints, 'score' => $score]);

            $result->update([
                'score' => $score,
                'answers' => json_encode($answers),
            ]);
            Log::info('Result updated', ['result_id' => $result->id, 'score' => $score]);

            try {
                Log::info('Attempting to send certificate', ['result_id' => $result->id]);
                $certificateSent = $this->sendCertificate($result); // Store the result
                Log::info('Certificate process completed', ['result_id' => $result->id, 'success' => $certificateSent]);
            } catch (\Exception $e) {
                Log::error('Failed to send certificate', [
                    'result_id' => $result->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            Log::info('Redirecting to result page', ['result_id' => $result->id, 'route' => 'course-exams.result']);
            return redirect()->route('course-exams.result', $result)
                ->with('success', 'تم تقديم الإجابات بنجاح');
        } catch (\Exception $e) {
            Log::error('Exception in submit method', [
                'exam_id' => $exam->id,
                'user_id' => $user->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
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
            $filename = 'certificate_' . uniqid() . '.pdf';
            $path = storage_path('app/public/certificates/' . $filename);

            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            $defaultConfig = config('gpdf');
            $config = new GpdfConfig($defaultConfig);
            $gpdf = new Gpdf($config);
            $html = view('course-exams.certificate', [
                'result' => $result,
                'title' => 'شهادة إجتياز - منصة زواج المودة'
            ])->render();

            $pdfContent = $gpdf->generate($html);
            file_put_contents($path, $pdfContent);

            // Verify file exists and is not empty
            if (!file_exists($path) || filesize($path) == 0) {
                throw new \Exception('Failed to generate valid PDF file');
            }

            $mailSent = Mail::to($result->user->email)->send(new ExamCertificate($result, $path));
            $result->update(['certificate_sent' => true]);
            unlink($path); // Delete file after sending
            return $mailSent !== null; // Return true if mail was sent successfully
        } catch (\Exception $e) {
            Log::error('فشل إنشاء الشهادة', [
                'result_id' => $result->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false; // Return false on failure
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
            return back()->with('error', 'حدث خطأ أثناء إعادة إرسال الشهادة.');
        }
    }

    /**
     * تنزيل الشهادة
     */

    public function downloadCertificate(CourseExamResult $result)
    {
        try {
            $result->loadMissing(['user', 'exam']);
            $filename = 'certificate_' . $result->id . '.pdf';
            $path = storage_path('app/public/certificates/' . $filename);

            if (!file_exists($path)) {
                if (!file_exists(dirname($path))) {
                    mkdir(dirname($path), 0755, true);
                }

                $defaultConfig = config('gpdf');
                $config = new GpdfConfig($defaultConfig);
                $gpdf = new Gpdf($config);
                $html = view('course-exams.certificate', [
                    'result' => $result,
                    'title' => 'شهادة إجتياز - منصة زواج المودة'
                ])->render();

                $pdfContent = $gpdf->generate($html);
                file_put_contents($path, $pdfContent);

                if (!file_exists($path) || filesize($path) == 0) {
                    throw new \Exception('Failed to generate valid PDF file');
                }
            }

            return response()->download($path, $filename)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->with('error', 'فشل تنزيل الشهادة: ' . $e->getMessage());
        }
    }
}
