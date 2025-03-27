<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:1000|min:10',
            'course_description' => 'nullable|string|max:1000',
            'ebook_url' => 'nullable|url|max:255',
            'youtube_playlist' => 'required|url|max:255',
            'registration_link' => 'required|url|max:255',
            'supporting_companies' => 'required|string|max:500',
            'intro_video' => 'nullable|url|max:255',
            'exam_link' => 'nullable|url|max:255',
            'exam_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'honor_students' => 'nullable|string|max:1000',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'url' => 'حقل :attribute يجب أن يكون رابطًا صحيحًا.',
            'date' => 'حقل :attribute يجب أن يكون تاريخًا صحيحًا.',
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
            'youtube_playlist' => 'رابط قائمة التشغيل',
            'registration_link' => 'رابط التسجيل',
            'supporting_companies' => 'الشركات الداعمة',
            'intro_video' => 'الفيديو التعريفي',
            'exam_link' => 'رابط الامتحان',
            'exam_date' => 'تاريخ الامتحان',
            'start_date' => 'تاريخ البدء',
            'end_date' => 'تاريخ الانتهاء',
            'honor_students' => 'الطلاب المتميزين',
        ]);

        $validated['supporting_companies'] = explode(',', $validated['supporting_companies']);
        $validated['honor_students'] = !empty($validated['honor_students']) ? explode(',', $validated['honor_students']) : [];

        $course = Course::create($validated);

        if ($request->has('episodes')) {
            foreach ($request->input('episodes') as $index => $episodeData) {
                if (!empty($episodeData['title']) && !empty($episodeData['url'])) {
                    $course->episodes()->create([
                        'episode_number' => $index + 1,
                        'title' => $episodeData['title'],
                        'url' => $episodeData['url'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.courses.index')->with('success', 'تم إضافة الدورة بنجاح');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:1000|min:10',
            'course_description' => 'nullable|string|max:1000',
            'ebook_url' => 'nullable|url|max:255',
            'youtube_playlist' => 'required|url|max:255',
            'registration_link' => 'required|url|max:255',
            'supporting_companies' => 'required|string|max:500',
            'intro_video' => 'nullable|url|max:255',
            'exam_link' => 'nullable|url|max:255',
            'exam_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'honor_students' => 'nullable|string|max:1000',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'url' => 'حقل :attribute يجب أن يكون رابطًا صحيحًا.',
            'date' => 'حقل :attribute يجب أن يكون تاريخًا صحيحًا.',
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
            'youtube_playlist' => 'رابط قائمة التشغيل',
            'registration_link' => 'رابط التسجيل',
            'supporting_companies' => 'الشركات الداعمة',
            'intro_video' => 'الفيديو التعريفي',
            'exam_link' => 'رابط الامتحان',
            'exam_date' => 'تاريخ الامتحان',
            'start_date' => 'تاريخ البدء',
            'end_date' => 'تاريخ الانتهاء',
            'honor_students' => 'الطلاب المتميزين',
        ]);

        $validated['supporting_companies'] = array_filter(
            array_map('trim', explode(',', $validated['supporting_companies'])),
            function ($item) {
                return !empty($item);
            }
        );

        $validated['honor_students'] = !empty($validated['honor_students'])
            ? array_filter(
                array_map('trim', explode(',', $validated['honor_students'])),
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
                        'url' => $episodeData['url'],
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
