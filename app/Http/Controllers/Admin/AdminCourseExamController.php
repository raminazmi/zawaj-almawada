<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseExam;
use App\Models\CourseExamQuestion;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AdminCourseExamController extends Controller
{
    /**
     * عرض قائمة الاختبارات
     */
    public function index()
    {
        $exams = Cache::remember('exams_list', 60 * 60, function () {
            return CourseExam::latest()->get();
        });
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * عرض نموذج إنشاء اختبار جديد
     */
    public function create()
    {
        $types = QuestionType::all();
        return view('admin.exams.create', compact('types'));
    }

    /**
     * حفظ اختبار جديد
     */
    public function store(Request $request)
    {
        Log::info('بدء عملية إنشاء اختبار جديد', $request->all());

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|integer|min:1',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'is_active' => 'nullable|boolean',
                'questions' => 'required|array|min:1',
                'questions.*.text' => 'required|string',
                'questions.*.type_id' => 'required|exists:question_types,id',
                'questions.*.options' => 'nullable|array',
                'questions.*.options.*.text' => 'nullable|string',
                'questions.*.options.*.is_correct' => 'nullable|boolean',
            ], [
                'title.required' => 'حقل العنوان مطلوب',
                'title.string' => 'يجب أن يكون العنوان نصًا',
                'title.max' => 'العنوان لا يمكن أن يتجاوز 255 حرفًا',
                'description.string' => 'يجب أن يكون الوصف نصًا',
                'duration.required' => 'حقل المدة مطلوب',
                'duration.integer' => 'يجب أن تكون المدة عددًا صحيحًا',
                'duration.min' => 'يجب أن تكون المدة دقيقة واحدة على الأقل',
                'start_time.required' => 'حقل وقت البدء مطلوب',
                'start_time.date' => 'وقت البدء غير صالح',
                'end_time.required' => 'حقل وقت الانتهاء مطلوب',
                'end_time.date' => 'وقت الانتهاء غير صالح',
                'end_time.after' => 'يجب أن يكون وقت الانتهاء بعد وقت البدء',
                'is_active.boolean' => 'القيمة المحددة لحقل التفعيل غير صحيحة',
                'questions.required' => 'يجب إضافة سؤال واحد على الأقل',
                'questions.array' => 'الأسئلة يجب أن تكون في صيغة صحيحة',
                'questions.min' => 'يجب إضافة سؤال واحد على الأقل',
                'questions.*.text.required' => 'نص السؤال مطلوب',
                'questions.*.text.string' => 'يجب أن يكون نص السؤال نصًا',
                'questions.*.type_id.required' => 'نوع السؤال مطلوب',
                'questions.*.type_id.exists' => 'نوع السؤال المحدد غير موجود',
                'questions.*.options.array' => 'الخيارات يجب أن تكون في صيغة صحيحة',
                'questions.*.options.*.text.string' => 'يجب أن يكون نص الخيار نصًا',
                'questions.*.options.*.is_correct.boolean' => 'القيمة المحددة لصحة الخيار غير صحيحة',
            ]);

            $exam = CourseExam::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'duration' => $validated['duration'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'is_active' => $request->boolean('is_active', false),
            ]);

            foreach ($validated['questions'] as $questionData) {
                $question = $exam->questions()->create([
                    'question' => $questionData['text'],
                    'question_type_id' => $questionData['type_id'],
                ]);

                if ($question->type->name === 'اختيار من متعدد' && isset($questionData['options'])) {
                    foreach ($questionData['options'] as $optionData) {
                        if (!empty($optionData['text'])) {
                            $question->options()->create([
                                'text' => $optionData['text'],
                                'is_correct' => $optionData['is_correct'] ?? false,
                            ]);
                        }
                    }
                }
            }

            Cache::forget('exams_list');
            Cache::forget('active_exams');

            return redirect()->route('admin.exams.index')->with('success', 'تم إنشاء الاختبار بنجاح.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('فشل التحقق من البيانات', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('خطأ أثناء إنشاء الاختبار', ['message' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء إنشاء الاختبار.');
        }
    }

    /**
     * عرض نموذج تعديل اختبار
     */
    public function edit(CourseExam $exam)
    {
        $types = QuestionType::all();
        $exam->load('questions.options', 'questions.type');
        return view('admin.exams.edit', compact('exam', 'types'));
    }

    /**
     * تحديث اختبار موجود
     */
    public function update(Request $request, CourseExam $exam)
    {
        Log::info("تحديث اختبار: {$exam->id}", $request->all());

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|integer|min:1',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'is_active' => 'nullable|boolean',
                'questions' => 'nullable|array',
                'questions.*.text' => 'required_with:questions|string',
                'questions.*.type_id' => 'required_with:questions|exists:question_types,id',
                'questions.*.options' => 'nullable|array',
                'questions.*.options.*.text' => 'required_with:questions.*.options|string',
                'questions.*.options.*.is_correct' => 'nullable|boolean',
            ], [
                'title.required' => 'حقل العنوان مطلوب',
                'title.string' => 'يجب أن يكون العنوان نصًا',
                'title.max' => 'العنوان لا يمكن أن يتجاوز 255 حرفًا',
                'description.string' => 'يجب أن يكون الوصف نصًا',
                'duration.required' => 'حقل المدة مطلوب',
                'duration.integer' => 'يجب أن تكون المدة عددًا صحيحًا',
                'duration.min' => 'يجب أن تكون المدة دقيقة واحدة على الأقل',
                'start_time.required' => 'حقل وقت البدء مطلوب',
                'start_time.date' => 'وقت البدء غير صالح',
                'end_time.required' => 'حقل وقت الانتهاء مطلوب',
                'end_time.date' => 'وقت الانتهاء غير صالح',
                'end_time.after' => 'يجب أن يكون وقت الانتهاء بعد وقت البدء',
                'is_active.boolean' => 'القيمة المحددة لحقل التفعيل غير صحيحة',
                'questions.array' => 'الأسئلة يجب أن تكون في صيغة صحيحة',
                'questions.*.text.required_with' => 'نص السؤال مطلوب عند إضافة أسئلة',
                'questions.*.text.string' => 'يجب أن يكون نص السؤال نصًا',
                'questions.*.type_id.required_with' => 'نوع السؤال مطلوب عند إضافة أسئلة',
                'questions.*.type_id.exists' => 'نوع السؤال المحدد غير موجود',
                'questions.*.options.array' => 'الخيارات يجب أن تكون في صيغة صحيحة',
                'questions.*.options.*.text.required_with' => 'نص الخيار مطلوب عند إضافة خيارات',
                'questions.*.options.*.text.string' => 'يجب أن يكون نص الخيار نصًا',
                'questions.*.options.*.is_correct.boolean' => 'القيمة المحددة لصحة الخيار غير صحيحة',
            ]);

            $exam->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'duration' => $validated['duration'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'is_active' => $request->boolean('is_active', false),
            ]);

            $exam->questions()->each(function ($question) {
                $question->options()->delete();
                $question->delete();
            });

            if (isset($validated['questions'])) {
                foreach ($validated['questions'] as $questionData) {
                    $question = $exam->questions()->create([
                        'question' => $questionData['text'],
                        'question_type_id' => $questionData['type_id'],
                    ]);

                    if ($question->type->name === 'اختيار من متعدد' && isset($questionData['options'])) {
                        foreach ($questionData['options'] as $optionData) {
                            if (!empty($optionData['text'])) {
                                $question->options()->create([
                                    'text' => $optionData['text'],
                                    'is_correct' => $optionData['is_correct'] ?? false,
                                ]);
                            }
                        }
                    }
                }
            }

            Cache::forget('exams_list');
            Cache::forget('active_exams');

            return redirect()->route('admin.exams.index')->with('success', 'تم تحديث الاختبار بنجاح.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('فشل التحقق من البيانات', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('خطأ أثناء تحديث الاختبار', ['message' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء تحديث الاختبار.');
        }
    }

    /**
     * حذف اختبار
     */
    public function destroy(CourseExam $exam)
    {
        try {
            $exam->delete();
            Cache::forget('exams_list');
            Cache::forget('active_exams');
            return redirect()->route('admin.exams.index')->with('success', 'تم حذف الاختبار بنجاح.');
        } catch (\Exception $e) {
            Log::error('خطأ أثناء حذف الاختبار', ['message' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء حذف الاختبار.');
        }
    }

    /**
     * عرض أسئلة الاختبار
     */
    public function questions(CourseExam $exam)
    {
        $questions = $exam->questions()->with('type', 'options')->get();
        return view('admin.exams.questions.index', compact('exam', 'questions'));
    }

    /**
     * عرض نموذج إضافة سؤال جديد
     */
    public function createQuestion(CourseExam $exam)
    {
        $types = QuestionType::all();
        return view('admin.exams.questions.create', compact('exam', 'types'));
    }

    /**
     * حفظ سؤال جديد
     */
    public function storeQuestion(Request $request, CourseExam $exam)
    {
        Log::info("بدء عملية إضافة سؤال جديد للاختبار: {$exam->id}", $request->all());

        try {
            $validated = $request->validate([
                'text' => 'required|string',
                'type_id' => 'required|exists:question_types,id',
                'options' => 'nullable|array',
                'options.*.text' => 'required_if:type_id,1|string|nullable',
                'options.*.is_correct' => 'nullable|boolean',
                'correct_answer' => 'required_if:type_id,2|in:true,false|nullable',
                'correct_answer_sa' => 'required_if:type_id,3|string|nullable',
            ], [
                'text.required' => 'نص السؤال مطلوب',
                'text.string' => 'يجب أن يكون نص السؤال نصًا',
                'type_id.required' => 'نوع السؤال مطلوب',
                'type_id.exists' => 'نوع السؤال المحدد غير موجود',
                'options.array' => 'الخيارات يجب أن تكون في صيغة صحيحة',
                'options.*.text.required_if' => 'نص الخيار مطلوب لأسئلة الاختيار من متعدد',
                'options.*.text.string' => 'يجب أن يكون نص الخيار نصًا',
                'options.*.is_correct.boolean' => 'القيمة المحددة لصحة الخيار غير صحيحة',
                'correct_answer.required_if' => 'الإجابة الصحيحة مطلوبة لأسئلة صح أو خطأ',
                'correct_answer.in' => 'الإجابة الصحيحة يجب أن تكون "صح" أو "خطأ"',
                'correct_answer_sa.required_if' => 'الإجابة الصحيحة مطلوبة لأسئلة النص القصير',
                'correct_answer_sa.string' => 'يجب أن تكون الإجابة الصحيحة نصًا',
            ]);

            // التحقق من وجود خيار صحيح واحد على الأقل لأسئلة الاختيار من متعدد
            if ($validated['type_id'] == 1 && isset($validated['options'])) {
                $hasCorrectOption = collect($validated['options'])->contains('is_correct', true);
                if (!$hasCorrectOption) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'options' => ['يجب تحديد خيار صحيح واحد على الأقل لأسئلة الاختيار من متعدد'],
                    ]);
                }
            }

            $questionType = QuestionType::find($validated['type_id']);
            $questionData = [
                'question' => $validated['text'],
                'question_type_id' => $validated['type_id'],
            ];

            if ($questionType->name === 'صح أو خطأ') {
                $questionData['correct_answer'] = $validated['correct_answer'];
            } elseif ($questionType->name === 'نص قصير') {
                $questionData['correct_answer'] = $validated['correct_answer_sa'];
            }

            $question = $exam->questions()->create($questionData);

            if ($questionType->name === 'اختيار من متعدد' && isset($validated['options'])) {
                foreach ($validated['options'] as $optionData) {
                    if (!empty($optionData['text'])) {
                        $question->options()->create([
                            'text' => $optionData['text'],
                            'is_correct' => $optionData['is_correct'] ?? false,
                        ]);
                    }
                }
            }

            Cache::forget('exams_list');
            Cache::forget('active_exams');

            return redirect()->route('admin.exams.questions', $exam)->with('success', 'تمت إضافة السؤال بنجاح.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('فشل التحقق من البيانات أثناء إضافة السؤال', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('خطأ أثناء إضافة السؤال', ['message' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء إضافة السؤال.');
        }
    }

    /**
     * عرض نموذج تعديل سؤال
     */
    public function editQuestion(CourseExam $exam, CourseExamQuestion $question)
    {
        $types = QuestionType::all();
        $question->load('options');
        return view('admin.exams.questions.edit', compact('exam', 'question', 'types'));
    }

    /**
     * تحديث سؤال موجود
     */
    public function updateQuestion(Request $request, CourseExam $exam, CourseExamQuestion $question)
    {
        Log::info("تحديث سؤال: {$question->id} للاختبار: {$exam->id}", $request->all());

        try {
            $validated = $request->validate([
                'text' => 'required|string',
                'type_id' => 'required|exists:question_types,id',
                'options' => 'nullable|array',
                'options.*.text' => 'required_if:type_id,1|string|nullable',
                'options.*.is_correct' => 'nullable|boolean',
                'correct_answer' => 'required_if:type_id,2|in:true,false|nullable',
                'correct_answer_sa' => 'required_if:type_id,3|string|nullable',
            ], [
                'text.required' => 'نص السؤال مطلوب',
                'text.string' => 'يجب أن يكون نص السؤال نصًا',
                'type_id.required' => 'نوع السؤال مطلوب',
                'type_id.exists' => 'نوع السؤال المحدد غير موجود',
                'options.array' => 'الخيارات يجب أن تكون في صيغة صحيحة',
                'options.*.text.required_if' => 'نص الخيار مطلوب لأسئلة الاختيار من متعدد',
                'options.*.text.string' => 'يجب أن يكون نص الخيار نصًا',
                'options.*.is_correct.boolean' => 'القيمة المحددة لصحة الخيار غير صحيحة',
                'correct_answer.required_if' => 'الإجابة الصحيحة مطلوبة لأسئلة صح أو خطأ',
                'correct_answer.in' => 'الإجابة الصحيحة يجب أن تكون "صح" أو "خطأ"',
                'correct_answer_sa.required_if' => 'الإجابة الصحيحة مطلوبة لأسئلة النص القصير',
                'correct_answer_sa.string' => 'يجب أن تكون الإجابة الصحيحة نصًا',
            ]);

            // التحقق من وجود خيار صحيح واحد على الأقل لأسئلة الاختيار من متعدد
            if ($validated['type_id'] == 1 && isset($validated['options'])) {
                $hasCorrectOption = collect($validated['options'])->contains('is_correct', true);
                if (!$hasCorrectOption) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'options' => ['يجب تحديد خيار صحيح واحد على الأقل لأسئلة الاختيار من متعدد'],
                    ]);
                }
            }

            $questionType = QuestionType::find($validated['type_id']);
            $updateData = [
                'question' => $validated['text'],
                'question_type_id' => $validated['type_id'],
                'correct_answer' => null,
            ];

            if ($questionType->name === 'صح أو خطأ') {
                $updateData['correct_answer'] = $validated['correct_answer'];
            } elseif ($questionType->name === 'نص قصير') {
                $updateData['correct_answer'] = $validated['correct_answer_sa'];
            }

            $question->update($updateData);
            $question->options()->delete();

            if ($questionType->name === 'اختيار من متعدد' && isset($validated['options'])) {
                foreach ($validated['options'] as $optionData) {
                    if (!empty($optionData['text'])) {
                        $question->options()->create([
                            'text' => $optionData['text'],
                            'is_correct' => $optionData['is_correct'] ?? false,
                        ]);
                    }
                }
            }

            Cache::forget('exams_list');
            Cache::forget('active_exams');

            return redirect()->route('admin.exams.questions', $exam)->with('success', 'تم تحديث السؤال بنجاح.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('فشل التحقق من البيانات أثناء تحديث السؤال', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('خطأ أثناء تحديث السؤال', ['message' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء تحديث السؤال.');
        }
    }

    /**
     * حذف سؤال
     */
    public function destroyQuestion(CourseExam $exam, CourseExamQuestion $question)
    {
        try {
            $question->delete();
            Cache::forget('exams_list');
            Cache::forget('active_exams');
            return redirect()->route('admin.exams.questions', $exam)->with('success', 'تم حذف السؤال بنجاح.');
        } catch (\Exception $e) {
            Log::error('خطأ أثناء حذف السؤال', ['message' => $e->getMessage()]);
            return back()->with('error', 'حدث خطأ أثناء حذف السؤال.');
        }
    }
}
