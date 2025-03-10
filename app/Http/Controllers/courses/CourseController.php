<?php

namespace App\Http\Controllers\courses;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->latest()
            ->paginate(9);

        return view('courses.index', compact('courses'));
    }
}
