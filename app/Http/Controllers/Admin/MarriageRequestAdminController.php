<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarriageRequest;
use Illuminate\Http\Request;
use App\Mail\CompatibilityTestLinkNotification;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;
use Illuminate\Support\Facades\Mail;

class MarriageRequestAdminController extends Controller
{
    public function index()
    {
        // الطلبات المعلقة للموافقة النهائية (admin_approval_status = pending)
        $pendingRequests = MarriageRequest::where('admin_approval_status', 'pending')
            ->with(['user', 'target'])
            ->latest()
            ->get();

        // جميع الطلبات الأخرى
        $allRequests = MarriageRequest::where('admin_approval_status', '!=', 'pending')
            ->with(['user', 'target'])
            ->latest()
            ->get();

        return view('admin.marriage-requests.index', compact('pendingRequests', 'allRequests'));
    }

    public function sendTestLink($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);

        $testLink = route('dashboard');

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

        // تحديث الحالة
        $marriageRequest->update([
            'admin_approval_status' => 'approved',
        ]);

        // إرسال الإشعارات
        $this->sendApprovalNotifications($marriageRequest);

        return back()->with('success', 'تمت الموافقة النهائية بنجاح');
    }

    public function reject($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);

        // تحديث حالة المستخدمين
        $marriageRequest->user()->update(['status' => 'available']);
        $marriageRequest->target()->update(['status' => 'available']);

        // تحديث حالة الطلب
        $marriageRequest->update([
            'admin_approval_status' => 'rejected',
        ]);

        // إرسال الإشعارات
        $this->sendRejectionNotifications($marriageRequest);

        return back()->with('success', 'تم رفض الطلب بنجاح');
    }

    public function pending($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);

        // تحديث حالة المستخدمين
        $marriageRequest->user()->update(['status' => 'pending']);
        $marriageRequest->target()->update(['status' => 'pending']);

        // تحديث حالة الطلب
        $marriageRequest->update([
            'admin_approval_status' => 'pending',
        ]);

        return back()->with('success', 'تم تعديل الطلب بنجاح');
    }

    private function sendApprovalNotifications($marriageRequest)
    {
        $dashboardLink = route('dashboard');

        Mail::to($marriageRequest->user->email)
            ->send(new RequestApproved($marriageRequest->user, $marriageRequest, $dashboardLink));

        Mail::to($marriageRequest->target->email)
            ->send(new RequestApproved($marriageRequest->target, $marriageRequest, $dashboardLink));
    }

    private function sendRejectionNotifications($marriageRequest)
    {
        $dashboardLink = route('dashboard');
        $reason = 'تم الرفض من قبل الإدارة';

        Mail::to($marriageRequest->user->email)
            ->send(new RequestRejected($marriageRequest->user, $marriageRequest, $dashboardLink, $reason));

        Mail::to($marriageRequest->target->email)
            ->send(new RequestRejected($marriageRequest->target, $marriageRequest, $dashboardLink, $reason));
    }
}
