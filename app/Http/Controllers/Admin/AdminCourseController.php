<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
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
            'ebook_url' => 'nullable|url|max:255',
            'youtube_playlist' => 'required|url|max:255',
            'registration_link' => 'required|url|max:255',
            'supporting_companies' => 'required|string|max:500',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'url' => 'حقل :attribute يجب أن يكون رابطًا صحيحًا.',
            'max' => [
                'string' => 'حقل :attribute يجب أن لا يتجاوز :max حروف.',
            ],
            'min' => [
                'string' => 'حقل :attribute يجب أن لا يقل عن :min حروف.',
            ],
            'attributes' => [
                'title' => 'عنوان الدورة',
                'description' => 'الوصف',
                'ebook_url' => 'رابط الكتاب الإلكتروني',
                'youtube_playlist' => 'رابط اليوتيوب',
                'registration_link' => 'رابط التسجيل',
                'supporting_companies' => 'الشركات الداعمة',
            ],
        ]);

        $validated['supporting_companies'] = explode(',', $validated['supporting_companies']);

        Course::create($validated);
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
            'ebook_url' => 'nullable|url|max:255',
            'youtube_playlist' => 'required|url|max:255',
            'registration_link' => 'required|url|max:255',
            'supporting_companies' => 'required|string|max:500',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'url' => 'حقل :attribute يجب أن يكون رابطًا صحيحًا.',
            'max' => [
                'string' => 'حقل :attribute يجب أن لا يتجاوز :max حروف.',
            ],
            'min' => [
                'string' => 'حقل :attribute يجب أن لا يقل عن :min حروف.',
            ],
            'attributes' => [
                'title' => 'عنوان الدورة',
                'description' => 'الوصف',
                'ebook_url' => 'رابط الكتاب الإلكتروني',
                'youtube_playlist' => 'رابط اليوتيوب',
                'registration_link' => 'رابط التسجيل',
                'supporting_companies' => 'الشركات الداعمة',
            ],
        ]);
        $validated['supporting_companies'] = explode(',', $validated['supporting_companies']);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'تم تحديث الدورة بنجاح');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->back()->with('success', 'تم حذف الدورة بنجاح');
    }
}
