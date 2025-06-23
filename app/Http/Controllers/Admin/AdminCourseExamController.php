<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseExam;
use App\Models\CourseExamQuestion;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AdminCourseExamController extends Controller
{
    // عرض كل الامتحانات
    public function index()
    {
        $exams = CourseExam::latest()->get();
        return view('admin.exams.index', compact('exams'));
    }

    // عرض فورم إنشاء امتحان جديد
    public function create()
    {
        $types = QuestionType::all();
        return view('admin.exams.create', compact('types'));
    }

    // حفظ امتحان جديد مع أسئلته
    public function store(Request $request)
    {
        Log::info('--- AdminCourseExamController@store: Initiated ---');
        Log::info('Incoming Request Data:', $request->all());

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|integer|min:1',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'is_active' => 'nullable',
                'questions' => 'required|array|min:1',
                'questions.*.text' => 'required|string',
                'questions.*.type_id' => 'required|exists:question_types,id',
                'questions.*.options' => 'nullable|array',
                'questions.*.options.*.text' => 'nullable|string',
                'questions.*.options.*.is_correct' => 'nullable|string',
            ]);
            Log::info('Validation Passed Successfully.');
        } catch (ValidationException $e) {
            Log::error('VALIDATION FAILED:', $e->errors());
            throw $e;
        }

        $examData = $request->only('title', 'description', 'duration', 'start_time', 'end_time');
        $examData['is_active'] = $request->has('is_active');
        Log::info('Preparing to create exam with data:', $examData);

        $exam = CourseExam::create($examData);
        Log::info("Exam Created Successfully. ID: {$exam->id}");

        if (isset($validated['questions'])) {
            Log::info('Processing questions array...');
            foreach ($validated['questions'] as $key => $questionData) {
                Log::info("--> Processing question #{$key}:", $questionData);

                $question = $exam->questions()->create([
                    'question' => $questionData['text'],
                    'question_type_id' => $questionData['type_id'],
                ]);
                Log::info("    Question #{$key} created with ID: {$question->id}");

                $questionType = QuestionType::find($questionData['type_id']);

                if ($questionType && $questionType->name === 'اختيار من متعدد' && isset($questionData['options'])) {
                    Log::info("    Question type is 'Multiple Choice'. Processing options...");
                    foreach ($questionData['options'] as $optKey => $optionData) {
                        if (!empty($optionData['text'])) {
                            Log::info("    ----> Processing option #{$optKey}:", $optionData);
                            $isCorrect = (isset($optionData['is_correct']) && $optionData['is_correct'] == '1') ? 1 : 0;
                            $createdOption = $question->options()->create([
                                'text' => $optionData['text'],
                                'is_correct' => $isCorrect,
                            ]);
                            Log::info("        Option #{$optKey} created with ID: {$createdOption->id}");
                        } else {
                            Log::info("    ----> Skipping empty option #{$optKey}.");
                        }
                    }
                }
            }
        } else {
            Log::warning('No "questions" array was found in the validated data.');
        }

        Log::info('--- AdminCourseExamController@store: Completed. Redirecting... ---');
        return redirect()->route('admin.exams.index')->with('success', 'تم إنشاء الاختبار بنجاح.');
    }

    // عرض فورم تعديل امتحان
    public function edit(CourseExam $exam)
    {
        $types = QuestionType::all();
        $exam->load('questions.options', 'questions.type');
        return view('admin.exams.edit', compact('exam', 'types'));
    }

    // تحديث امتحان موجود
    public function update(Request $request, CourseExam $exam)
    {
        Log::info("--- AdminCourseExamController@update: Initiated for Exam ID: {$exam->id} ---");
        Log::info('Incoming Request Data:', $request->all());

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|integer|min:1',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'is_active' => 'nullable',
                'questions' => 'nullable|array',
                'questions.*.text' => 'required_with:questions|string',
                'questions.*.type_id' => 'required_with:questions|exists:question_types,id',
                'questions.*.options' => 'nullable|array',
                'questions.*.options.*.text' => 'required_with:questions.*.options|string',
                'questions.*.options.*.is_correct' => 'nullable|string',
            ]);
            Log::info('Validation Passed Successfully.');
        } catch (ValidationException $e) {
            Log::error('VALIDATION FAILED:', $e->errors());
            throw $e;
        }

        $examData = $request->only('title', 'description', 'duration', 'start_time', 'end_time');
        $examData['is_active'] = $request->has('is_active');
        Log::info("Preparing to update exam ID {$exam->id} with data:", $examData);
        $exam->update($examData);
        Log::info("Exam ID {$exam->id} updated successfully.");

        Log::info("Deleting old questions for exam ID {$exam->id}...");
        $exam->questions()->each(function ($question) {
            $question->options()->delete();
            $question->delete();
        });
        Log::info("Old questions deleted.");

        if (isset($validated['questions'])) {
            Log::info('Processing new questions array...');
            foreach ($validated['questions'] as $key => $questionData) {
                Log::info("--> Processing question #{$key}:", $questionData);
                $question = $exam->questions()->create([
                    'question' => $questionData['text'],
                    'question_type_id' => $questionData['type_id'],
                ]);
                Log::info("    Question #{$key} created with ID: {$question->id}");
                $questionType = QuestionType::find($questionData['type_id']);
                if ($questionType && $questionType->name === 'اختيار من متعدد' && isset($questionData['options'])) {
                    foreach ($questionData['options'] as $optionData) {
                        if (!empty($optionData['text'])) {
                            $question->options()->create([
                                'text' => $optionData['text'],
                                'is_correct' => isset($optionData['is_correct']) ? 1 : 0
                            ]);
                        }
                    }
                }
            }
        }
        Log::info("--- AdminCourseExamController@update: Completed for Exam ID: {$exam->id}. Redirecting... ---");
        return redirect()->route('admin.exams.index')->with('success', 'تم تحديث الاختبار بنجاح.');
    }

    // حذف امتحان
    public function destroy(CourseExam $exam)
    {
        $exam->delete();
        return redirect()->route('admin.exams.index')->with('success', 'تم حذف الاختبار بنجاح.');
    }

    // --- إدارة الأسئلة بشكل منفصل ---

    // عرض أسئلة اختبار معين
    public function questions(CourseExam $exam)
    {
        $questions = $exam->questions()->with('type', 'options')->get();
        return view('admin.exams.questions.index', compact('exam', 'questions'));
    }

    // عرض فورم إضافة سؤال جديد
    public function createQuestion(CourseExam $exam)
    {
        $types = QuestionType::all();
        return view('admin.exams.questions.create', compact('exam', 'types'));
    }

    // حفظ سؤال جديد
    public function storeQuestion(Request $request, CourseExam $exam)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'type_id' => 'required|exists:question_types,id',
            'options' => 'nullable|array',
            'options.*.text' => 'nullable|string',
            'options.*.is_correct' => 'nullable',
            'correct_answer' => 'nullable|string',
            'correct_answer_sa' => 'nullable|string',
        ]);

        $questionType = QuestionType::find($validated['type_id']);

        $questionData = [
            'question' => $request->input('text'),
            'question_type_id' => $request->input('type_id'),
        ];

        if ($questionType && $questionType->name === 'صح أو خطأ') {
            $questionData['correct_answer'] = $request->input('correct_answer');
        } elseif ($questionType && $questionType->name === 'نص قصير') {
            $questionData['correct_answer'] = $request->input('correct_answer_sa');
        }

        $question = $exam->questions()->create($questionData);

        if ($questionType && $questionType->name === 'اختيار من متعدد' && isset($validated['options'])) {
            foreach ($validated['options'] as $optionData) {
                if (!empty($optionData['text'])) {
                    $question->options()->create([
                        'text' => $optionData['text'],
                        'is_correct' => isset($optionData['is_correct']) ? 1 : 0
                    ]);
                }
            }
        }

        return redirect()->route('admin.exams.questions', $exam)->with('success', 'تمت إضافة السؤال بنجاح.');
    }

    // عرض فورم تعديل سؤال
    public function editQuestion(CourseExam $exam, CourseExamQuestion $question)
    {
        $types = QuestionType::all();
        $question->load('options');
        return view('admin.exams.questions.edit', compact('exam', 'question', 'types'));
    }

    // تحديث سؤال موجود
    public function updateQuestion(Request $request, CourseExam $exam, CourseExamQuestion $question)
    {
        $request->validate([
            'text' => 'required|string',
            'type_id' => 'required|exists:question_types,id',
            'options' => 'nullable|array',
            'options.*.text' => 'nullable|string',
            'options.*.is_correct' => 'nullable',
            'correct_answer' => 'nullable|string',
            'correct_answer_sa' => 'nullable|string',
        ]);

        $questionType = QuestionType::find($request->input('type_id'));

        $updateData = [
            'question' => $request->input('text'),
            'question_type_id' => $request->input('type_id'),
            'correct_answer' => null // Reset correct answer first
        ];

        if ($questionType && $questionType->name === 'صح أو خطأ') {
            $updateData['correct_answer'] = $request->input('correct_answer');
        } elseif ($questionType && $questionType->name === 'نص قصير') {
            $updateData['correct_answer'] = $request->input('correct_answer_sa');
        }

        $question->update($updateData);

        // Delete old options and recreate them
        $question->options()->delete();

        if ($questionType && $questionType->name === 'اختيار من متعدد' && $request->has('options')) {
            foreach ($request->options as $optionData) {
                if (!empty($optionData['text'])) {
                    $question->options()->create([
                        'text' => $optionData['text'],
                        'is_correct' => isset($optionData['is_correct']) ? 1 : 0
                    ]);
                }
            }
        }

        return redirect()->route('admin.exams.questions', $exam)->with('success', 'تم تحديث السؤال بنجاح.');
    }

    // حذف سؤال
    public function destroyQuestion(CourseExam $exam, CourseExamQuestion $question)
    {
        $question->delete();
        return redirect()->route('admin.exams.questions', $exam)->with('success', 'تم حذف السؤال بنجاح.');
    }
}