<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarriageRequest;
use Illuminate\Http\Request;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;
use Illuminate\Support\Facades\Mail;

class MarriageRequestAdminController extends Controller
{
    public function index()
    {
        $pendingRequests = MarriageRequest::where('status', 'pending')->get();
        $allRequests = MarriageRequest::where('status', '!=', 'pending')->get();
        return view('admin.marriage-requests.index', compact('pendingRequests', 'allRequests'));
    }

    public function approve($id)
    {
        $request = MarriageRequest::findOrFail($id);
        $request->update(['status' => 'approved']);
        Mail::to($request->user->email)->send(new RequestApproved($request->user, $request));
        Mail::to($request->target->email)->send(new RequestApproved($request->target, $request));
        return redirect()->back()->with('success', 'تمت الموافقة على الطلب بنجاح');
    }

    public function reject($id)
    {
        $request = MarriageRequest::findOrFail($id);
        $request->user->update(['status' => 'available']);
        $request->target->update(['status' => 'available']);
        $request->update(['status' => 'rejected']);
        Mail::to($request->user->email)->send(new RequestRejected($request->user, $request));
        Mail::to($request->target->email)->send(new RequestRejected($request->target, $request));
        return redirect()->back()->with('success', 'تم رفض الطلب بنجاح');
    }

    public function approveFinal($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        if ($marriageRequest->status !== 'engaged' || !$marriageRequest->real_name || !$marriageRequest->village || !$marriageRequest->compatibility_test_link) {
            return back()->with('error', 'الطلب غير مكتمل أو ليس في مرحلة الموافقة النهائية');
        }

        $marriageRequest->update(['admin_approved' => true]);
        Mail::to($marriageRequest->user->email)->send(new RequestApproved($marriageRequest->user, $marriageRequest));
        Mail::to($marriageRequest->target->email)->send(new RequestApproved($marriageRequest->target, $marriageRequest));
        return back()->with('success', 'تمت الموافقة النهائية على الطلب');
    }
}
