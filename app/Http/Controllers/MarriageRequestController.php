<?php

namespace App\Http\Controllers;

use App\Models\MarriageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MarriageRequestNotification;

class MarriageRequestController extends Controller
{
    // عرض نموذج التقديم
    public function create()
    {
        return view('marriage-requests.create', [
            'type' => Auth::user()->gender
        ]);
    }

    // حفظ الطلب
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->activeMarriageRequest) {
            return redirect()->back()->with('error', 'لديك طلب قيد المراجعة بالفعل');
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
            'children_count' => 'nullable|integer|min:0',
            'education_level' => 'required|in:illiterate,general,diploma,bachelor,master,phd',
            'work_sector' => 'required|in:government,private,self_employed,unemployed',
            'job_title' => 'required|string|max:255',
            'monthly_income' => 'required|numeric|min:0',
            'religion' => 'required|string|max:255',
            'genetic_diseases' => 'nullable|string',
            'infectious_diseases' => 'nullable|string',
            'psychological_disorders' => 'nullable|string',
            'housing_type' => 'required|in:independent,family_annex,family_room',
            'health_status' => 'required|string',
            'has_disability' => 'required|boolean',
            'disability_details' => 'nullable|string',
            'has_deformity' => 'required|boolean',
            'deformity_details' => 'nullable|string',
            'wants_children' => 'required|boolean',
            'infertility' => 'required|boolean',
            'religiosity_level' => 'required|in:high,medium,low',
            'prayer_commitment' => 'required|in:yes,sometimes,no',
            'personal_description' => 'required|string|max:2000',
            'partner_expectations' => 'required|string|max:2000'
        ]);
        $marriageRequest = MarriageRequest::create([
            'user_id' => $user->id,
            'applicant_type' => $user->gender,
            'request_number' => 'MRQ-' . time(),
            ...$validated
        ]);

        $user->update(['current_marriage_request_id' => $marriageRequest->id]);

        return redirect()->route('marriage-requests.status');
    }

    // عرض حالة الطلب
    public function status()
    {
        $request = Auth::user()->activeMarriageRequest;
        return view('marriage-requests.status', compact('request'));
    }

    // إرسال طلب التقدم للخطوبة
    public function sendProposal(Request $request, MarriageRequest $target)
    {
        $user = Auth::user();

        if ($user->activeMarriageRequest->target_user_id) {
            return back()->with('error', 'لا يمكنك إرسال أكثر من طلب');
        }

        $user->activeMarriageRequest->update([
            'target_user_id' => $target->user_id,
            'status' => 'pending_approval'
        ]);

        Mail::to($target->user->email)->send(new MarriageRequestNotification($user, $target));

        return back()->with('success', 'تم إرسال الطلب بنجاح');
    }

    // معالجة القبول/الرفض
    public function respondProposal(Request $request, MarriageRequest $proposal)
    {
        if ($request->action === 'accept') {
            $proposal->update(['status' => 'accepted']);
            // إرسال رابط المقياس
            $this->sendCompatibilityTestLink($proposal);
        } else {
            $proposal->update(['status' => 'rejected']);
            // إعادة فتح النظام للبحث
            $proposal->user->update(['current_marriage_request_id' => null]);
        }

        return back()->with('success', 'تمت العملية بنجاح');
    }

    private function sendCompatibilityTestLink($proposal)
    {
        // إرسال البريد الإلكتروني مع الرابط
    }
}
