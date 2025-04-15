<?php

namespace App\Http\Controllers\courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('episodes')->latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load('episodes');
        return view('courses.show', compact('course'));
    }
}
