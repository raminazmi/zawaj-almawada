<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseExam;
use App\Models\Episode;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('courseExam')->latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $exams = \App\Models\CourseExam::all();
        return view('admin.courses.create', compact('exams'));
    }

    public function convertToEmbedUrl($url)
    {
        if (empty($url)) {
            return null;
        }
        if (str_contains($url, 'youtube.com/embed')) {
            return $url;
        }
        $pattern = '~
        (?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)
        ([^"&?/\s]{11})
    ~ix';
        if (preg_match($pattern, $url, $matches)) {
            $videoId = $matches[1];
            return "https://www.youtube.com/embed/{$videoId}";
        }
        return $url;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:1000|min:10',
            'course_description' => 'nullable|string|max:1000',
            'ebook_url' => 'nullable|url|max:255',
            'registration_link' => 'required|url|max:255',
            'supporting_companies' => 'required|string|max:500',
            'intro_video' => 'nullable|url|max:255',
            'course_exam_id' => 'nullable|exists:course_exams,id',
            'exam_date' => 'nullable|date',
            'exam_time' => 'nullable|date_format:H:i',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'honor_students' => 'nullable|string|max:1000',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'url' => 'حقل :attribute يجب أن يكون رابطًا صحيحًا.',
            'date' => 'حقل :attribute يجب أن يكون تاريخًا صحيحًا.',
            'date_format' => 'حقل :attribute يجب أن يكون بصيغة ساعة صحيحة (مثل 14:30).',
            'max' => [
                'string' => 'حقل :attribute يجب أن لا يتجاوز :max حرفًا.',
                'file' => 'حقل :attribute يجب أن لا يتجاوز :max كيلوبايت.',
            ],
            'min' => [
                'string' => 'حقل :attribute يجب أن لا يقل عن :min حروف.',
            ],
        ], [
            'title' => 'عنوان الدورة',
            'description' => 'الوصف',
            'course_description' => 'الوصف التفصيلي',
            'ebook_url' => 'رابط الكتاب الإلكتروني',
            'registration_link' => 'رابط التسجيل',
            'supporting_companies' => 'الشركات الداعمة',
            'intro_video' => 'الفيديو التعريفي',
            'course_exam_id' => 'امتحان الدورة',
            'exam_date' => 'تاريخ الامتحان',
            'exam_time' => 'توقيت الامتحان',
            'start_date' => 'تاريخ البدء',
            'end_date' => 'تاريخ الانتهاء',
            'honor_students' => 'الطلاب المتميزين',
        ]);

        if (!empty($validated['intro_video'])) {
            $validated['intro_video'] = $this->convertToEmbedUrl($validated['intro_video']);
        }

        if (!empty($validated['course_exam_id'])) {
            $exam = CourseExam::find($validated['course_exam_id']);
            if ($exam) {
                $validated['exam_date'] = $exam->start_time->toDateString();
                $validated['exam_time'] = $exam->start_time->format('H:i');
                $validated['exam_link'] = route('course-exams.show', $exam);
            }
        } else {
            $validated['exam_link'] = null;
        }

        $validated['supporting_companies'] = explode('،', $validated['supporting_companies']);
        $validated['honor_students'] = !empty($validated['honor_students']) ? explode('،', $validated['honor_students']) : [];

        $course = Course::create($validated);

        if ($request->has('episodes')) {
            foreach ($request->input('episodes') as $index => $episodeData) {
                if (!empty($episodeData['title']) && !empty($episodeData['url'])) {
                    $course->episodes()->create([
                        'episode_number' => $index + 1,
                        'title' => $episodeData['title'],
                        'url' => $this->convertToEmbedUrl($episodeData['url']),
                    ]);
                }
            }
        }

        return redirect()->route('admin.courses.index')->with('success', 'تم إضافة الدورة بنجاح');
    }

    public function edit(Course $course)
    {
        $exams = \App\Models\CourseExam::all();
        return view('admin.courses.edit', compact('course', 'exams'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:1000|min:10',
            'course_description' => 'nullable|string|max:1000',
            'ebook_url' => 'nullable|url|max:255',
            'registration_link' => 'required|url|max:255',
            'supporting_companies' => 'required|string|max:500',
            'intro_video' => 'nullable|url|max:255',
            'course_exam_id' => 'nullable|exists:course_exams,id',
            'exam_date' => 'nullable|date',
            'exam_time' => 'nullable|date_format:H:i',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'honor_students' => 'nullable|string|max:1000',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'url' => 'حقل :attribute يجب أن يكون رابطًا صحيحًا.',
            'date' => 'حقل :attribute يجب أن يكون تاريخًا صحيحًا.',
            'date_format' => 'حقل :attribute يجب أن يكون بصيغة ساعة صحيحة (مثل 14:30).',
            'max' => [
                'string' => 'حقل :attribute يجب أن لا يتجاوز :max حرفًا.',
                'file' => 'حقل :attribute يجب أن لا يتجاوز :max كيلوبايت.',
            ],
            'min' => [
                'string' => 'حقل :attribute يجب أن لا يقل عن :min حروف.',
            ],
        ], [
            'title' => 'عنوان الدورة',
            'description' => 'الوصف',
            'course_description' => 'الوصف التفصيلي',
            'ebook_url' => 'رابط الكتاب الإلكتروني',
            'registration_link' => 'رابط التسجيل',
            'supporting_companies' => 'الشركات الداعمة',
            'intro_video' => 'الفيديو التعريفي',
            'course_exam_id' => 'امتحان الدورة',
            'exam_date' => 'تاريخ الامتحان',
            'exam_time' => 'توقيت الامتحان',
            'start_date' => 'تاريخ البدء',
            'end_date' => 'تاريخ الانتهاء',
            'honor_students' => 'الطلاب المتميزين',
        ]);

        if (!empty($validated['intro_video'])) {
            $validated['intro_video'] = $this->convertToEmbedUrl($validated['intro_video']);
        }

        if (!empty($validated['course_exam_id'])) {
            $exam = CourseExam::find($validated['course_exam_id']);
            if ($exam) {
                $validated['exam_date'] = $exam->start_time->toDateString();
                $validated['exam_time'] = $exam->start_time->format('H:i');
                $validated['exam_link'] = route('course-exams.show', $exam);
            }
        } else {
            $validated['exam_link'] = null;
        }

        $validated['supporting_companies'] = array_filter(
            array_map('trim', explode('،', $validated['supporting_companies'])),
            function ($item) {
                return !empty($item);
            }
        );

        $validated['honor_students'] = !empty($validated['honor_students'])
            ? array_filter(
                array_map('trim', explode('،', $validated['honor_students'])),
                function ($item) {
                    return !empty($item);
                }
            )
            : [];

        $course->update($validated);

        if ($request->has('episodes')) {
            $course->episodes()->delete();
            foreach ($request->input('episodes') as $index => $episodeData) {
                if (!empty($episodeData['title']) && !empty($episodeData['url'])) {
                    $course->episodes()->create([
                        'episode_number' => $index + 1,
                        'title' => $episodeData['title'],
                        'url' => $this->convertToEmbedUrl($episodeData['url']),
                    ]);
                }
            }
        }

        return redirect()->route('admin.courses.index')->with('success', 'تم تحديث الدورة بنجاح');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'تم حذف الدورة بنجاح');
    }
}
