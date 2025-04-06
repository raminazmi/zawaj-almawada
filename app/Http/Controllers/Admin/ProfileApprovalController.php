<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ProfileApprovalNotification;
use App\Mail\ProfileApprovedNotification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ProfileRejectedNotification;
use Illuminate\Support\Facades\Mail;

class ProfileApprovalController extends Controller
{
    public function index()
    {
        $pendingProfiles = User::where('profile_status', 'pending')
            ->where('is_admin', false)
            ->latest()
            ->paginate(2, ['*'], 'pending_page');

        $processedProfiles = User::whereIn('profile_status', ['approved', 'rejected'])
            ->where('is_admin', false)
            ->latest()
            ->take(20)
            ->paginate(2, ['*'], 'processed_page');

        return view('admin.profile-approvals.index', [
            'pendingProfiles' => $pendingProfiles,
            'processedProfiles' => $processedProfiles
        ]);
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['profile_status' => 'approved']);

        Mail::to($user->email)->send(new ProfileApprovedNotification($user));

        return back()->with('success', 'تمت الموافقة على الملف الشخصي بنجاح');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->update(['profile_status' => 'rejected']);

        Mail::to($user->email)->send(new ProfileRejectedNotification($user));

        return back()->with('success', 'تم رفض الملف الشخصي بنجاح');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profile-approvals.show', compact('user'));
    }

    public function pending($id)
    {
        $user = User::findOrFail($id);
        $user->update(['profile_status' => 'pending']);

        return back()->with('success', 'تم إعادة الملف إلى حالة بانتظار المراجعة');
    }
}
