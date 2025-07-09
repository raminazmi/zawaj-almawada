<?php

namespace App\Http\Controllers;

use App\Models\CourseExam;
use App\Models\CourseExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExamCertificate;
use Omaralalwi\Gpdf\Gpdf;
use Omaralalwi\Gpdf\GpdfConfig;

class CourseExamController extends Controller
{
    public function index()
    {
        $exams = CourseExam::getActiveExams();
        return view('course-exams.index', compact('exams'));
    }

    public function show(CourseExam $exam)
    {
        if (!$exam->is_active || now() < $exam->start_time || now() > $exam->end_time) {
            return redirect()->route('course-exams.index')
                ->with('error', 'الاختبار غير متاح حالياً');
        }

        $user = auth()->user();
        $result = $exam->results()->where('user_id', $user->id)->first();
        if ($result) {
            return redirect()->route('course-exams.result', $result)
                ->with('error', 'لقد أتممت هذا الاختبار مسبقًا ولا يمكنك إعادة المحاولة. يمكنك تحميل الشهادة الخاصة بك.');
        }
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

            $validated = $request->validate([
                'answers' => 'required|array',
                'answers.*' => 'string',
                'full_name' => 'nullable|string|max:255',
            ]);

            $answers = $request->input('answers');
            $fullName = $validated['full_name'];

            $user->update(['full_name' => $fullName]);

            $earnedPoints = 0;
            $totalPoints = 0;

            foreach ($exam->questions as $question) {
                $points = $question->points ?? 1;
                $totalPoints += $points;

                if (isset($answers[$question->id])) {
                    $userAnswer = trim(strtolower($answers[$question->id]));

                    if ($question->question_type_id == 1) {
                        $correctOption = $question->options->firstWhere('is_correct', true);
                        if ($correctOption && $userAnswer == trim(strtolower($correctOption->text))) {
                            $earnedPoints += $points;
                        }
                    } elseif ($question->question_type_id == 2) {
                        $correctAnswer = trim(strtolower($question->correct_answer));
                        if ($correctAnswer === 'true' || $correctAnswer === 'false') {
                            if ($userAnswer === $correctAnswer) {
                                $earnedPoints += $points;
                            }
                        }
                    } elseif ($question->question_type_id == 3) {
                        if ($question->correct_answer !== null) {
                            $correctAnswer = trim(strtolower($question->correct_answer));
                            if (str_contains($userAnswer, $correctAnswer)) {
                                $earnedPoints += $points;
                            } else {
                                $similarity = 0;
                                similar_text($userAnswer, $correctAnswer, $similarity);
                                if ($similarity >= 90) {
                                    $earnedPoints += $points;
                                }
                            }
                        }
                    }
                }
            }

            $score = $totalPoints > 0 ? ($earnedPoints / $totalPoints) * 100 : 0;

            $result->update([
                'score' => $score,
                'answers' => json_encode($answers),
            ]);

            try {
                if ($score < 60) {
                    $this->sendCertificate($result, 'attendance');
                } else {
                    $this->sendCertificate($result, 'success');
                }
            } catch (\Exception $e) {
            }

            return redirect()->route('course-exams.result', $result)
                ->with('success', 'تم تقديم الإجابات بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء تقديم الإجابات.');
        }
    }

    public function result(CourseExamResult $result)
    {
        $score = $result->score;
        return view('course-exams.result', compact('result', 'score'));
    }

    private function sendCertificate($result, $type = 'success')
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
                'title' => $type === 'attendance' ? 'شهادة حضور - منصة زواج المودة' : 'شهادة إجتياز - منصة زواج المودة',
                'type' => $type
            ])->render();

            $pdfContent = $gpdf->generate($html);
            file_put_contents($path, $pdfContent);

            if (!file_exists($path) || filesize($path) == 0) {
                throw new \Exception('Failed to generate valid PDF file');
            }

            Mail::to($result->user->email)->send(new \App\Mail\ExamCertificate($result, $path, $type));
            $result->update(['certificate_sent' => true]);
            unlink($path);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function resendCertificate(CourseExamResult $result)
    {
        try {
            $this->sendCertificate($result);
            return back()->with('success', 'تمت إعادة إرسال الشهادة بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إعادة إرسال الشهادة.');
        }
    }

    public function downloadCertificate(CourseExamResult $result)
    {
        try {
            $type = request('type', 'success');
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
                    'title' => $type === 'attendance' ? 'شهادة حضور - منصة زواج المودة' : 'شهادة إجتياز - منصة زواج المودة',
                    'type' => $type
                ])->render();

                $pdfContent = $gpdf->generate($html);
                file_put_contents($path, $pdfContent);

                if (!file_exists($path) || filesize($path) == 0) {
                    throw new \Exception('فشل إنشاء ملف PDF صالح');
                }
            }

            clearstatcache();
            if (file_exists($path) && filesize($path) > 0) {
                return response()->download($path, $filename)->deleteFileAfterSend(true);
            } else {
                throw new \Exception('الملف غير جاهز للتنزيل');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'فشل تنزيل الشهادة: ' . $e->getMessage());
        }
    }
}
