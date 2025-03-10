<?php

namespace App\Http\Controllers\MarriageRequests;

use App\Mail\MarriageProposalNotification;
use App\Mail\CompatibilityTestNotification;
use App\Mail\FinalApprovalNotification;
use App\Models\MarriageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\AdminMarriageProposalNotification;

class MarriageRequestController extends Controller
{
    public function index()
    {
        return view('marriage-requests.index');
    }

    public function boys()
    {
        if (Auth::user()->status !== 'available') {
            return redirect()->route('marriage-requests.status')->with('info', 'لديك طلب خطوبة نشط بالفعل');
        }
        $boys = User::where('gender', 'male')->where('status', 'available')->where('is_admin', false)->get();
        return view('marriage-requests.boys', compact('boys'));
    }

    public function girls()
    {
        if (Auth::user()->status !== 'available') {
            return redirect()->route('marriage-requests.status')->with('info', 'لديك طلب خطوبة نشط بالفعل');
        }
        $girls = User::where('gender', 'female')->where('status', 'available')->where('is_admin', false)->get();
        return view('marriage-requests.girls', compact('girls'));
    }

    public function createProposal($targetId)
    {
        if (Auth::user()->status !== 'available') {
            return redirect()->route('marriage-requests.status')->with('info', 'لديك طلب خطوبة نشط بالفعل');
        }
        $target = User::findOrFail($targetId);
        if ($target->status !== 'available') {
            return redirect()->back()->with('error', 'هذا الشخص غير متاح حاليًا لتقديم طلب خطوبة');
        }
        return view('marriage-requests.create-proposal', compact('target'));
    }

    public function storeProposal(Request $request, $targetId)
    {
        $user = Auth::user();
        if ($user->status !== 'available') {
            return redirect()->route('marriage-requests.status')->with('info', 'لديك طلب خطوبة نشط بالفعل');
        }
        $target = User::findOrFail($targetId);
        if ($target->status !== 'available') {
            return redirect()->back()->with('error', 'هذا الشخص غير متاح حاليًا لتقديم طلب خطوبة');
        }

        $validated = $request->validate([
            'state' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'height' => 'required|integer|min:100|max:250',
            'weight' => 'required|integer|min:30|max:300',
            'tribe' => 'required|string|max:255',
            'skin_color' => 'required|in:white,wheat,brown',
            'lineage' => 'required|in:1,2,3',
            'marital_status' => 'required|in:single,married,widowed,divorced',
            'has_children' => 'required|boolean',
            'children_count' => 'nullable|integer|min:0|max:20',
            'education_level' => 'required|in:illiterate,general,diploma,bachelor,master,phd',
            'work_sector' => 'required|in:government,private,self_employed,unemployed',
            'job_title' => 'required|string|max:255',
            'monthly_income' => 'required|numeric|min:0',
            'religion' => 'required|string|max:255',
            'genetic_diseases' => 'nullable|string|max:1000',
            'infectious_diseases' => 'nullable|string|max:1000',
            'psychological_disorders' => 'nullable|string|max:1000',
            'housing_type' => 'required|in:independent,family_annex,family_room,no_preference',
            'health_status' => 'required|string|max:1000',
            'has_disability' => 'required|boolean',
            'disability_details' => 'nullable|string|max:1000',
            'has_deformity' => 'required|boolean',
            'deformity_details' => 'nullable|string|max:1000',
            'wants_children' => 'required|boolean',
            'infertility' => 'required|boolean',
            'is_smoker' => $user->gender === 'male' ? 'required|boolean' : 'nullable|boolean',
            'religiosity_level' => 'required|in:high,medium,low',
            'prayer_commitment' => 'required|in:yes,sometimes,no',
            'personal_description' => 'required|string|max:2000',
            'partner_expectations' => 'required|string|max:2000',
        ]);

        $marriageRequest = MarriageRequest::create([
            'user_id' => $user->id,
            'target_user_id' => $target->id,
            'status' => 'pending',
            'request_number' => 'MRQ-' . time(),
            'applicant_type' => $user->gender,
            'state' => $validated['state'],
            'age' => $validated['age'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'tribe' => $validated['tribe'],
            'skin_color' => $validated['skin_color'],
            'lineage' => $validated['lineage'],
            'marital_status' => $validated['marital_status'],
            'has_children' => $validated['has_children'],
            'children_count' => $validated['children_count'],
            'education_level' => $validated['education_level'],
            'work_sector' => $validated['work_sector'],
            'job_title' => $validated['job_title'],
            'monthly_income' => $validated['monthly_income'],
            'religion' => $validated['religion'],
            'genetic_diseases' => $validated['genetic_diseases'],
            'infectious_diseases' => $validated['infectious_diseases'],
            'psychological_disorders' => $validated['psychological_disorders'],
            'housing_type' => $validated['housing_type'],
            'health_status' => $validated['health_status'],
            'has_disability' => $validated['has_disability'],
            'disability_details' => $validated['disability_details'],
            'has_deformity' => $validated['has_deformity'],
            'deformity_details' => $validated['deformity_details'],
            'wants_children' => $validated['wants_children'],
            'infertility' => $validated['infertility'],
            'is_smoker' => $user->gender === 'male' ? $validated['is_smoker'] : null,
            'religiosity_level' => $validated['religiosity_level'],
            'prayer_commitment' => $validated['prayer_commitment'],
            'personal_description' => $validated['personal_description'],
            'partner_expectations' => $validated['partner_expectations'],
        ]);

        $user->update(['status' => 'pending']);
        $target->update(['status' => 'pending']);

        Mail::to($target->email)->send(new MarriageProposalNotification($user, $target));
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new AdminMarriageProposalNotification($marriageRequest, $admin));
        }

        return redirect()->route('marriage-requests.status')->with('success', 'تم تقديم طلب الخطوبة بنجاح');
    }

    public function status()
    {
        $request = Auth::user()->activeMarriageRequest();
        $targetRequest = Auth::user()->targetMarriageRequest();
        return view('marriage-requests.status', compact('request', 'targetRequest'));
    }

    public function adminApproval()
    {
        $requests = MarriageRequest::where('status', 'pending')->with(['user', 'target'])->get();
        return view('marriage-requests.admin-approval', compact('requests'));
    }

    public function approve($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        $marriageRequest->update(['status' => 'approved']);
        return back()->with('success', 'تمت الموافقة على الطلب');
    }

    public function reject($id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        $marriageRequest->user->update(['status' => 'available']);
        $marriageRequest->target->update(['status' => 'available']);
        $marriageRequest->update(['status' => 'rejected']);
        return back()->with('success', 'تم رفض الطلب');
    }

    public function respond(Request $request, $id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        if ($marriageRequest->target_user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بالرد على هذا الطلب');
        }

        if ($request->action === 'accept') {
            $marriageRequest->update(['status' => 'engaged']);
            Mail::to($marriageRequest->user->email)->send(new CompatibilityTestNotification($marriageRequest->target, $marriageRequest));
            return back()->with('success', 'تم قبول الطلب، يرجى انتظار رابط اختبار المقياس من الطرف الآخر');
        } elseif ($request->action === 'reject') {
            $marriageRequest->user->update(['status' => 'available']);
            $marriageRequest->target->update(['status' => 'available']);
            $marriageRequest->update(['status' => 'rejected']);
            return back()->with('success', 'تم رفض الطلب، يمكنكما الآن البحث عن شريك آخر');
        }

        return redirect()->back()->with('error', 'الإجراء غير صالح');
    }

    public function submitTest(Request $request, $id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        if ($marriageRequest->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بإرسال الرابط');
        }

        $request->validate(['compatibility_test_link' => 'required|url']);
        $marriageRequest->update(['compatibility_test_link' => $request->compatibility_test_link]);
        Mail::to($marriageRequest->target->email)->send(new CompatibilityTestNotification($marriageRequest->user, $marriageRequest));

        return back()->with('success', 'تم إرسال رابط اختبار المقياس بنجاح');
    }

    public function finalApproval(Request $request, $id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        if (!in_array(Auth::id(), [$marriageRequest->user_id, $marriageRequest->target_user_id])) {
            return redirect()->back()->with('error', 'غير مصرح لك بالموافقة النهائية');
        }

        $request->validate([
            'real_name' => 'required|string|max:255',
            'village' => 'required|string|max:255',
        ]);

        $marriageRequest->update([
            'real_name' => $request->real_name,
            'village' => $request->village,
        ]);

        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new FinalApprovalNotification(Auth::user(), $marriageRequest));
        }

        return back()->with('success', 'تم إرسال بياناتك للموافقة النهائية من المدير');
    }
}
