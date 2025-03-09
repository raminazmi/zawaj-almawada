<?php

namespace App\Http\Controllers\MarriageRequests;

use App\Mail\MarriageProposalNotification;
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
        if (Auth::user()->status === 'engaged') {
            $partnerName = Auth::user()->activeMarriageRequest()
                ? Auth::user()->activeMarriageRequest()->target->name
                : Auth::user()->targetMarriageRequest()->user->name;
            return redirect()->route('marriage-requests.status')
                ->with('info', 'أنت متزوج بالفعل من ' . $partnerName);
        }
        $boys = User::where('gender', 'male')
            ->where('status', 'available')
            ->get();
        return view('marriage-requests.boys', compact('boys'));
    }

    public function girls()
    {
        if (Auth::user()->status === 'engaged') {
            $partnerName = Auth::user()->activeMarriageRequest()
                ? Auth::user()->activeMarriageRequest()->target->name
                : Auth::user()->targetMarriageRequest()->user->name;
            return redirect()->route('marriage-requests.status')
                ->with('info', 'أنت متزوج بالفعل من ' . $partnerName);
        }
        $girls = User::where('gender', 'female')
            ->where('status', 'available')
            ->get();
        return view('marriage-requests.girls', compact('girls'));
    }

    public function createProposal($targetId)
    {
        if (Auth::user()->status === 'engaged') {
            $partnerName = Auth::user()->activeMarriageRequest()
                ? Auth::user()->activeMarriageRequest()->target->name
                : Auth::user()->targetMarriageRequest()->user->name;
            return redirect()->route('marriage-requests.status')
                ->with('info', 'أنت متزوج بالفعل من ' . $partnerName);
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
        if ($user->status === 'engaged') {
            $partnerName = $user->activeMarriageRequest()
                ? $user->activeMarriageRequest()->target->name
                : $user->targetMarriageRequest()->user->name;
            return redirect()->route('marriage-requests.status')
                ->with('info', 'أنت متزوج بالفعل من ' . $partnerName);
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
            'housing_type' => 'required|in:independent,family_annex,family_room',
            'health_status' => 'required|string|max:1000',
            'has_disability' => 'required|boolean',
            'disability_details' => 'nullable|string|max:1000',
            'has_deformity' => 'required|boolean',
            'deformity_details' => 'nullable|string|max:1000',
            'wants_children' => 'required|boolean',
            'infertility' => 'required|boolean',
            'is_smoker' => 'nullable|boolean',
            'religiosity_level' => 'required|in:high,medium,low',
            'prayer_commitment' => 'required|in:yes,sometimes,no',
            'personal_description' => 'required|string|max:2000',
            'partner_expectations' => 'required|string|max:2000',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'max' => [
                'string' => 'حقل :attribute يجب أن لا يتجاوز :max حروف.',
            ],
            'min' => [
                'string' => 'حقل :attribute يجب أن لا يقل عن :min حروف.',
                'numeric' => 'حقل :attribute يجب أن لا يقل عن :min.',
            ],
            'integer' => 'حقل :attribute يجب أن يكون رقمًا صحيحًا.',
            'numeric' => 'حقل :attribute يجب أن يكون رقمًا.',
            'in' => 'القيمة المحددة لـ :attribute غير صالحة.',
            'boolean' => 'حقل :attribute يجب أن يكون نعم أو لا.',
            'age.min' => 'الحد الأدنى للعمر هو 18 سنة.',
            'age.max' => 'الحد الأقصى للعمر هو 100 سنة.',
            'height.min' => 'الحد الأدنى للطول هو 100 سم.',
            'height.max' => 'الحد الأقصى للطول هو 250 سم.',
            'weight.min' => 'الحد الأدنى للوزن هو 30 كجم.',
            'weight.max' => 'الحد الأقصى للوزن هو 300 كجم.',
            'children_count.min' => 'عدد الأبناء يجب أن لا يقل عن 0.',
            'children_count.max' => 'عدد الأبناء يجب أن لا يتجاوز 20.',
            'monthly_income.min' => 'الدخل الشهري يجب أن لا يقل عن 0.',
            'is_smoker.required' => 'حقل التدخين مخصص للشباب فقط.',
            'attributes' => [
                'state' => 'الولاية',
                'age' => 'العمر',
                'height' => 'الطول',
                'weight' => 'الوزن',
                'tribe' => 'القبيلة',
                'skin_color' => 'لون البشرة',
                'lineage' => 'النسب',
                'marital_status' => 'الحالة الاجتماعية',
                'has_children' => 'هل لديك أبناء',
                'children_count' => 'عدد الأبناء',
                'education_level' => 'المستوى التعليمي',
                'work_sector' => 'قطاع العمل',
                'job_title' => 'المسمى الوظيفي',
                'monthly_income' => 'الدخل الشهري',
                'religion' => 'الدين',
                'genetic_diseases' => 'الأمراض الوراثية',
                'infectious_diseases' => 'الأمراض المعدية',
                'psychological_disorders' => 'الأمراض النفسية',
                'housing_type' => 'نوع السكن',
                'health_status' => 'الحالة الصحية',
                'has_disability' => 'الإعاقة',
                'disability_details' => 'تفاصيل الإعاقة',
                'has_deformity' => 'التشوهات',
                'deformity_details' => 'تفاصيل التشوهات',
                'wants_children' => 'رغبة في الإنجاب',
                'infertility' => 'العقم',
                'is_smoker' => 'التدخين',
                'religiosity_level' => 'مستوى التدين',
                'prayer_commitment' => 'التزام الصلاة',
                'personal_description' => 'الوصف الشخصي',
                'partner_expectations' => 'توقعات الشريك',
            ],
        ]);
        $marriageRequest = MarriageRequest::create([
            'user_id' => Auth::id(),
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
            'children_count' => $validated['children_count'] ?? null,
            'education_level' => $validated['education_level'],
            'work_sector' => $validated['work_sector'],
            'job_title' => $validated['job_title'],
            'monthly_income' => $validated['monthly_income'],
            'religion' => $validated['religion'],
            'genetic_diseases' => $validated['genetic_diseases'] ?? null,
            'infectious_diseases' => $validated['infectious_diseases'] ?? null,
            'psychological_disorders' => $validated['psychological_disorders'] ?? null,
            'housing_type' => $validated['housing_type'],
            'health_status' => $validated['health_status'],
            'has_disability' => $validated['has_disability'],
            'disability_details' => $validated['disability_details'] ?? null,
            'has_deformity' => $validated['has_deformity'],
            'deformity_details' => $validated['deformity_details'] ?? null,
            'wants_children' => $validated['wants_children'],
            'infertility' => $validated['infertility'],
            'is_smoker' => $validated['is_smoker'] ?? 0,
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
            $marriageRequest->user->update(['status' => 'engaged']);
            $marriageRequest->target->update(['status' => 'engaged']);
            return back()->with('success', 'تمت الخطوبة بنجاح');
        } elseif ($request->action === 'reject') {
            $marriageRequest->user->update(['status' => 'available']);
            $marriageRequest->target->update(['status' => 'available']);
            $marriageRequest->update(['status' => 'rejected']);
            return back()->with('success', 'تم رفض الطلب وأصبحتما متاحين لتقديم طلبات جديدة');
        }

        return redirect()->back()->with('error', 'الإجراء غير صالح');
    }
}
