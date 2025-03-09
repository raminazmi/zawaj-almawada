<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarriageRequest;
use Illuminate\Http\Request;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;
use App\Models\User;
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
        $request->user->update(['status' => 'engaged']);
        $request->target->update(['status' => 'engaged']);

        Mail::to($request->user->email)->send(new RequestApproved($request->user, $request));
        Mail::to($request->target->email)->send(new RequestApproved($request->target, $request));
        return redirect()->back()->with('success', 'تمت الموافقة على الطلب بنجاح');
    }

    public function reject($id)
    {
        $request = MarriageRequest::findOrFail($id);

        $request->update(['status' => 'rejected']);
        $request->user->update(['status' => 'available']);
        $request->target->update(['status' => 'available']);

        Mail::to($request->user->email)->send(new RequestRejected($request->user, $request));
        Mail::to($request->target->email)->send(new RequestRejected($request->target, $request));

        return redirect()->back()->with('success', 'تم رفض الطلب بنجاح');
    }

    public function approveFinal(MarriageRequest $marriageRequest)
    {
        if ($marriageRequest->status !== 'engaged') {
            return back()->with('error', 'الطلب ليس في مرحلة الموافقة النهائية');
        }

        $marriageRequest->update(['status' => 'approved']);
        return back()->with('success', 'تمت الموافقة النهائية على الطلب');
    }
}
