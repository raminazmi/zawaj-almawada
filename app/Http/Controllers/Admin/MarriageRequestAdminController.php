<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarriageRequest;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Mail\CompatibilityTestLinkNotification;
use App\Mail\ProfileApprovalNotification;
use App\Mail\ProfileRejectedNotification;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;
use Illuminate\Support\Facades\Mail;

class MarriageRequestAdminController extends Controller
{
    public function index()
    {
        $pendingRequests = MarriageRequest::where('admin_approval_status', 'pending')
            ->with(['user', 'target', 'exam'])
            ->latest()
            ->get();

        $allRequests = MarriageRequest::where('admin_approval_status', '!=', 'pending')
            ->with(['user', 'target', 'exam'])
            ->latest()
            ->get();

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
        $marriageRequest = MarriageRequest::findOrFail($id);

        $marriageRequest->user()->update(['status' => 'engaged']);
        $marriageRequest->target()->update(['status' => 'engaged']);
        $marriageRequest->update([
            'admin_approval_status' => 'approved',
        ]);

        $this->sendApprovalNotifications($marriageRequest);

        return back()->with('success', 'تمت الموافقة النهائية بنجاح');
    }

    public function reject($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);

        $marriageRequest->user()->update(['status' => 'available']);
        $marriageRequest->target()->update(['status' => 'available']);

        $marriageRequest->update([
            'admin_approval_status' => 'rejected',
        ]);

        $this->sendRejectionNotifications($marriageRequest);

        return back()->with('success', 'تم رفض الطلب بنجاح');
    }

    public function pending($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        $marriageRequest->user()->update(['status' => 'pending']);
        $marriageRequest->target()->update(['status' => 'pending']);
        $marriageRequest->update([
            'admin_approval_status' => 'pending',
        ]);

        return back()->with('success', 'تم تعديل الطلب بنجاح');
    }

    private function sendApprovalNotifications($marriageRequest)
    {
        $dashboardLink = route('exam.pledge');

        Mail::to($marriageRequest->user->email)
            ->send(new RequestApproved($marriageRequest->user, $marriageRequest, $dashboardLink));

        Mail::to($marriageRequest->target->email)
            ->send(new RequestApproved($marriageRequest->target, $marriageRequest, $dashboardLink));
    }

    private function sendRejectionNotifications($marriageRequest)
    {
        $dashboardLink = route('exam.pledge');
        $reason = 'تم الرفض من قبل الإدارة';

        Mail::to($marriageRequest->user->email)
            ->send(new RequestRejected($marriageRequest->user, $marriageRequest, $dashboardLink, $reason));

        Mail::to($marriageRequest->target->email)
            ->send(new RequestRejected($marriageRequest->target, $marriageRequest, $dashboardLink, $reason));
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
}
