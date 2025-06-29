<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarriageRequest;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Mail\CompatibilityTestLinkNotification;
use App\Mail\FinalApprovalNotification;
use App\Mail\ProfileApprovalNotification;
use App\Mail\ProfileRejectedNotification;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MarriageRequestAdminController extends Controller
{
    public function index()
    {
        $pendingRequests = MarriageRequest::where('status', 'awaiting_admin_approval')
            ->where('user_approval', true)
            ->where('target_approval', true)
            ->with(['user', 'target', 'exam'])
            ->latest()
            ->paginate(2, ['*'], 'pending_page');

        $allRequests = MarriageRequest::where('admin_approval_status', '!=', 'pending')
            ->with(['user', 'target', 'exam'])
            ->latest()
            ->paginate(2, ['*'], 'processed_page');

        foreach ($pendingRequests as $request) {
            if (!$request->exam) {
                $exam = Exam::where(function ($query) use ($request) {
                    $query->where('male_user_id', $request->user->gender === 'male' ? $request->user_id : $request->target_user_id)
                        ->where('female_user_id', $request->user->gender === 'female' ? $request->user_id : $request->target_user_id);
                })->orWhere(function ($query) use ($request) {
                    $query->where('male_user_id', $request->user->gender === 'female' ? $request->user_id : $request->target_user_id)
                        ->where('female_user_id', $request->user->gender === 'male' ? $request->user_id : $request->target_user_id);
                })->first();

                if ($exam) {
                    $request->setRelation('exam', $exam);
                }
            }
        }

        foreach ($allRequests as $request) {
            if (!$request->exam) {
                $exam = Exam::where(function ($query) use ($request) {
                    $query->where('male_user_id', $request->user->gender === 'male' ? $request->user_id : $request->target_user_id)
                        ->where('female_user_id', $request->user->gender === 'female' ? $request->user_id : $request->target_user_id);
                })->orWhere(function ($query) use ($request) {
                    $query->where('male_user_id', $request->user->gender === 'female' ? $request->user_id : $request->target_user_id)
                        ->where('female_user_id', $request->user->gender === 'male' ? $request->user_id : $request->target_user_id);
                })->first();

                if ($exam) {
                    $request->setRelation('exam', $exam);
                }
            }
        }

        return view('admin.marriage-requests.index', compact('pendingRequests', 'allRequests'));
    }

    public function sendTestLink($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        if (!$marriageRequest->exam) {
            $exam = Exam::create([
                'male_user_id' => $marriageRequest->user->gender === 'male' ? $marriageRequest->user_id : $marriageRequest->target_user_id,
                'female_user_id' => $marriageRequest->user->gender === 'female' ? $marriageRequest->user_id : $marriageRequest->target_user_id,
                'token' => \Illuminate\Support\Str::random(60),
                'male_finished' => false,
                'female_finished' => false,
            ]);

            $marriageRequest->update(['exam_id' => $exam->id]);
        }

        $testLink = route('exam.pledge', ['token' => $marriageRequest->exam->token]);

        $marriageRequest->update([
            'compatibility_test_link' => $testLink,
            'test_link_sent' => true,
        ]);

        Mail::to($marriageRequest->user->email)->send(new CompatibilityTestLinkNotification($marriageRequest->user, $marriageRequest));
        Mail::to($marriageRequest->target->email)->send(new CompatibilityTestLinkNotification($marriageRequest->target, $marriageRequest));

        return back()->with('success', 'تم إرسال الرابط بنجاح');
    }

    public function approveFinal($id)
    {
        $marriageRequest = MarriageRequest::with('exam')->findOrFail($id);

        $marriageRequest->update([
            'admin_approval_status' => 'approved',
            'status' => 'engaged',
        ]);
        $marriageRequest->user->update(['status' => 'engaged']);
        $marriageRequest->target->update(['status' => 'engaged']);

        $maleUserId = $marriageRequest->user->gender === 'male' ? $marriageRequest->user_id : $marriageRequest->target_user_id;
        $femaleUserId = $marriageRequest->user->gender === 'female' ? $marriageRequest->user_id : $marriageRequest->target_user_id;

        $exam = Exam::where('male_user_id', $maleUserId)
            ->where('female_user_id', $femaleUserId)
            ->first();

        if (!$exam) {
            $exam = Exam::create([
                'male_user_id' => $maleUserId,
                'female_user_id' => $femaleUserId,
                'token' => Str::random(60)
            ]);
        }

        $testLink = route('exam.index', ['token' => $exam->token]);
        $testResult = ($exam && $exam->male_finished && $exam->female_finished) ? $exam->calculateScore() : null;

        Mail::to($marriageRequest->user->email)->send(
            new FinalApprovalNotification(
                $marriageRequest->user,
                $marriageRequest->target,
                $testLink,
                $testResult,
                $exam
            )
        );

        Mail::to($marriageRequest->target->email)->send(
            new FinalApprovalNotification(
                $marriageRequest->target,
                $marriageRequest->user,
                $testLink,
                $testResult,
                $exam
            )
        );

        return redirect()->back()->with('success', 'تمت الموافقة النهائية على الطلب');
    }

    public function reject($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);

        $marriageRequest->user()->update(['status' => 'available']);
        $marriageRequest->target()->update(['status' => 'available']);

        $marriageRequest->update([
            'admin_approval_status' => 'rejected',
        ]);

        $maleUserId = $marriageRequest->user->gender === 'male' ? $marriageRequest->user_id : $marriageRequest->target_user_id;
        $femaleUserId = $marriageRequest->user->gender === 'female' ? $marriageRequest->user_id : $marriageRequest->target_user_id;

        $exam = Exam::where('male_user_id', $maleUserId)
            ->where('female_user_id', $femaleUserId)
            ->first();

        $reason = 'تم الرفض من قبل الإدارة';
        if ($exam && $exam->male_finished && $exam->female_finished) {
            $score = $exam->calculateScore();
            if ($score < 90) {
                $reason = 'نسبة التوافق بين الخاطبين متدنية';
            }
        }

        $this->sendRejectionNotifications($marriageRequest, $reason);

        return back()->with('success', 'تم رفض الطلب بنجاح');
    }

    public function pending($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        $marriageRequest->user()->update(['status' => 'pending']);
        $marriageRequest->target()->update(['status' => 'pending']);
        $marriageRequest->update([
            'admin_approval_status' => 'pending',
            'status' => 'approved'
        ]);

        return back()->with('success', 'تم تعديل الطلب بنجاح');
    }

    private function sendRejectionNotifications($marriageRequest, $reason)
    {
        $dashboardLink = route('exam.pledge');

        Mail::to($marriageRequest->user->email)
            ->send(new RequestRejected($marriageRequest->user, $marriageRequest, $reason));

        Mail::to($marriageRequest->target->email)
            ->send(new RequestRejected($marriageRequest->target, $marriageRequest, $reason));
    }

    public function approveProfile($userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['profile_status' => 'approved']);
        Mail::to($user->email)->send(new ProfileApprovalNotification($user));

        return back()->with('success', 'تمت الموافقة على الملف الشخصي');
    }

    public function rejectProfile($userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['profile_status' => 'rejected']);

        Mail::to($user->email)->send(new ProfileRejectedNotification($user));

        return back()->with('success', 'تم رفض الملف الشخصي');
    }

    public function pendingRequestsOverdue()
    {
        $pendingRequests = MarriageRequest::where('status', 'pending')
            ->where('created_at', '<', now()->subDays(7))
            ->with(['user', 'target'])
            ->paginate(10);

        return view('admin.marriage-requests.pending-overdue', compact('pendingRequests'));
    }

    public function deletePendingOverdue($id)
    {
        $request = MarriageRequest::findOrFail($id);

        $request->user->update(['status' => 'available']);
        $request->target->update(['status' => 'available']);

        $request->forceDelete();

        return back()->with('success', 'تم حذف الطلب المعلق بنجاح وإعادة المستخدمين إلى حالة متاح');
    }

    public function deleteAllPendingOverdue()
    {
        $pendingRequests = MarriageRequest::where('status', 'pending')
            ->where('created_at', '<', now()->subDays(7))
            ->with(['user', 'target'])
            ->get();

        foreach ($pendingRequests as $request) {
            $request->user->update(['status' => 'available']);
            $request->target->update(['status' => 'available']);
            $request->forceDelete();
        }

        return back()->with('success', 'تم حذف جميع الطلبات المعلقة المتجاوزة بنجاح وإعادة المستخدمين إلى حالة متاح');
    }

    public function expiredEngagements()
    {
        $expiredRequests = MarriageRequest::where('admin_approval_status', 'approved')
            ->where('status', 'engaged')
            ->where('created_at', '<', now()->subDays(60))
            ->with(['user', 'target', 'exam'])
            ->paginate(10);

        return view('admin.marriage-requests.expired', compact('expiredRequests'));
    }

    public function deleteExpired($id)
    {
        $request = MarriageRequest::findOrFail($id);
        $request->user->update(['status' => 'available']);
        $request->target->update(['status' => 'available']);
        $request->forceDelete();
        return back()->with('success', 'تم حذف الطلب بنجاح وإعادة المستخدمين إلى حالة متاح');
    }

    public function deleteAllExpired()
    {
        $expiredRequests = MarriageRequest::where('admin_approval_status', 'approved')
            ->where('status', 'engaged')
            ->where('created_at', '<', now()->subDays(60))
            ->with(['user', 'target'])
            ->get();

        foreach ($expiredRequests as $request) {
            $request->user->update(['status' => 'available']);
            $request->target->update(['status' => 'available']);
            $request->forceDelete();
        }

        return back()->with('success', 'تم حذف جميع الطلبات المنتهية بنجاح وإعادة المستخدمين إلى حالة متاح');
    }
}
