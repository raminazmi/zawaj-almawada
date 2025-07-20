<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseExamResult;
use App\Models\CourseExam;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = CourseExamResult::with(['user', 'exam'])
            ->orderBy('created_at', 'desc');

        // Filter by exam
        if ($request->filled('exam_id')) {
            $query->where('course_exam_id', $request->exam_id);
        }

        // Filter by score range
        if ($request->filled('score_min')) {
            $query->where('score', '>=', $request->score_min);
        }
        if ($request->filled('score_max')) {
            $query->where('score', '<=', $request->score_max);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by user name or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $results = $query->paginate(20);
        $exams = CourseExam::orderBy('title')->get();

        // Statistics
        $stats = [
            'total_certificates' => CourseExamResult::count(),
            'passing_certificates' => CourseExamResult::where('score', '>=', 60)->count(),
            'attendance_certificates' => CourseExamResult::where('score', '<', 60)->count(),
            'average_score' => round(CourseExamResult::avg('score'), 2),
            'highest_score' => CourseExamResult::max('score'),
            'lowest_score' => CourseExamResult::min('score'),
        ];

        return view('admin.certificates.index', compact('results', 'exams', 'stats'));
    }

    public function show(CourseExamResult $result)
    {
        $result->load(['user', 'exam']);
        return view('admin.certificates.show', compact('result'));
    }

    public function download(CourseExamResult $result, $type = 'success')
    {
        $result->load(['user', 'exam']);

        $title = $type === 'attendance' ? 'شهادة حضور' : 'شهادة إجتياز';

        $pdf = \PDF::loadView('course-exams.certificate', [
            'result' => $result,
            'title' => $title,
            'type' => $type
        ]);

        $filename = $type === 'attendance' ? 'attendance_certificate.pdf' : 'success_certificate.pdf';

        return $pdf->download($filename);
    }

    public function export(Request $request)
    {
        $query = CourseExamResult::with(['user', 'exam'])
            ->orderBy('created_at', 'desc');

        // Apply same filters as index
        if ($request->filled('exam_id')) {
            $query->where('course_exam_id', $request->exam_id);
        }
        if ($request->filled('score_min')) {
            $query->where('score', '>=', $request->score_min);
        }
        if ($request->filled('score_max')) {
            $query->where('score', '<=', $request->score_max);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $results = $query->get();

        $filename = 'certificates_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($results) {
            $file = fopen('php://output', 'w');

            // Add BOM for Arabic text
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Headers
            fputcsv($file, [
                'اسم المستخدم',
                'الاسم الكامل',
                'رقم الجوال',
                'البريد الإلكتروني',
                'عنوان الاختبار',
                'العلامة',
                'نوع الشهادة',
                'تاريخ الإصدار',
                'الوقت'
            ]);

            // Data
            foreach ($results as $result) {
                $certificateType = $result->score >= 60 ? 'شهادة إجتياز' : 'شهادة حضور';

                fputcsv($file, [
                    $result->user->name ?? 'غير متوفر',
                    $result->user->full_name ?? 'غير متوفر',
                    $result->user->phone ?? 'غير متوفر',
                    $result->user->email ?? 'غير متوفر',
                    $result->exam->title ?? 'غير متوفر',
                    round($result->score),
                    $certificateType,
                    $result->created_at->format('Y-m-d'),
                    $result->created_at->format('H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function delete(CourseExamResult $result)
    {
        $result->delete();
        return redirect()->route('admin.certificates.index')
            ->with('success', 'تم حذف الشهادة بنجاح');
    }
}
