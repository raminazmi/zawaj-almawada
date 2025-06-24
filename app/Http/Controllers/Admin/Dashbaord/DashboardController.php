<?php

namespace App\Http\Controllers\Admin\Dashbaord;

use App\Http\Controllers\Controller;
use App\Models\BusinessActivity;
use App\Models\Course;
use App\Models\CourseExam;
use App\Models\CourseExamResult;
use App\Models\MarriageRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * عرض صفحة لوحة التحكم مع الإحصائيات.
     */
    public function index()
    {
        // 1. تجميع كل الإحصائيات في مصفوفة واحدة
        $stats = [
            'userCount' => User::count(),
            'courseCount' => Course::count(),
            'shopCount' => BusinessActivity::count(),
            'marriageRequestCount' => MarriageRequest::count(),
            'pendingMarriageRequests' => MarriageRequest::where('status', 'pending')->count(),
            'examCount' => CourseExam::count(),
            'examResultCount' => CourseExamResult::count(),
            'latestUsers' => User::latest()->take(5)->get(),
            'latestCourses' => Course::latest()->take(5)->get(),
            'latestMarriageRequests' => MarriageRequest::with('user')->latest()->take(5)->get(), // إزالة .profile
            'genderDistribution' => User::select('gender', DB::raw('count(*) as total'))
                ->groupBy('gender')
                ->pluck('total', 'gender'),
        ];

        // 2. إرسال المصفوفة إلى الـ view
        return view('admin.dashboard.index', compact('stats'));
    }
}
