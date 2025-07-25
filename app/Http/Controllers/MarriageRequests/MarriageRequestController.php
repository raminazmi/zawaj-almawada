<?php

namespace App\Http\Controllers\MarriageRequests;

use App\Mail\MarriageProposalNotification;
use App\Mail\CompatibilityTestNotification;
use App\Mail\FinalApprovalNotification;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;
use App\Mail\TargetRequestRejected;
use App\Mail\UserConfirmationNotification;
use App\Mail\UserRejectedNotification;
use App\Models\MarriageRequest;
use App\Models\User;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\AdminMarriageProposalNotification;
use App\Mail\CompatibilityTestLinkNotification;
use Illuminate\Support\Str;

class MarriageRequestController extends Controller
{
    public function isProfileComplete($user)
    {
        $requiredFields = [
            'state',
            'tribe',
            'lineage',
            'marital_status',
            'has_children',
            'education_level',
            'work_sector',
            'job_title',
            'monthly_income',
            'religion',
            'housing_type',
            'health_status',
            'has_disability',
            'has_deformity',
            'wants_children',
            'infertility',
            'religiosity_level',
            'prayer_commitment',
            'personal_description',
            'partner_expectations'
        ];

        if ($user->gender === 'male') {
            $requiredFields[] = 'is_smoker';
        }

        foreach ($requiredFields as $field) {
            if (is_null($user->$field)) {
                return false;
            }
        }

        return true;
    }

    public function boys(Request $request)
    {
        $query = User::where('gender', 'male')
            ->where('status', 'available')
            ->where('show_profile', true)
            ->whereNotNull([
                'state',
                'tribe',
                'marital_status',
                'education_level',
                'job_title',
                'monthly_income',
                'religion',
                'housing_type',
                'health_status',
                'religiosity_level',
                'prayer_commitment',
                'personal_description',
                'partner_expectations'
            ]);

        // تطبيق البحث النصي
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('membership_number', 'like', "%{$search}%")
                    ->orWhere('personal_description', 'like', "%{$search}%")
                    ->orWhere('partner_expectations', 'like', "%{$search}%");
            });
        }

        // تطبيق الفلاتر
        if ($request->has('age_min') && !empty($request->age_min)) {
            $query->where('age', '>=', $request->age_min);
        }
        if ($request->has('age_max') && !empty($request->age_max)) {
            $query->where('age', '<=', $request->age_max);
        }
        if ($request->has('marital_status') && !empty($request->marital_status)) {
            $query->where('marital_status', $request->marital_status);
        }
        if ($request->has('education_level') && !empty($request->education_level)) {
            $query->where('education_level', $request->education_level);
        }
        if ($request->has('monthly_income_min') && !empty($request->monthly_income_min)) {
            $query->where('monthly_income', '>=', $request->monthly_income_min);
        }
        if ($request->has('monthly_income_max') && !empty($request->monthly_income_max)) {
            $query->where('monthly_income', '<=', $request->monthly_income_max);
        }
        if ($request->has('religion') && !empty($request->religion)) {
            $query->where('religion', $request->religion);
        }
        if ($request->has('housing_type') && !empty($request->housing_type)) {
            $query->where('housing_type', $request->housing_type);
        }
        if ($request->has('health_status') && !empty($request->health_status)) {
            $query->where('health_status', $request->health_status);
        }
        if ($request->has('religiosity_level') && !empty($request->religiosity_level)) {
            $query->where('religiosity_level', $request->religiosity_level);
        }
        if ($request->has('prayer_commitment') && !empty($request->prayer_commitment)) {
            $query->where('prayer_commitment', $request->prayer_commitment);
        }
        if ($request->has('has_children') && !empty($request->has_children)) {
            $query->where('has_children', $request->has_children === 'yes' ? 1 : 0);
        }
        if ($request->has('is_smoker') && !empty($request->is_smoker)) {
            $query->where('is_smoker', $request->is_smoker === 'yes' ? 1 : 0);
        }

        $boys = $query->get();

        if (Auth::user()->status !== 'available') {
            return redirect()->route('marriage-requests.status')->with('info', 'لديك طلب خطوبة نشط بالفعل');
        }
        $isProfileComplete = $this->isProfileComplete(Auth::user());

        return view('marriage-requests.boys', compact('boys', 'isProfileComplete'));
    }

    public function girls(Request $request)
    {
        $query = User::where('gender', 'female')
            ->where('status', 'available')
            ->where('show_profile', true)
            ->whereNotNull([
                'state',
                'tribe',
                'marital_status',
                'education_level',
                'job_title',
                'monthly_income',
                'religion',
                'housing_type',
                'health_status',
                'religiosity_level',
                'prayer_commitment',
                'personal_description',
                'partner_expectations'
            ]);

        // تطبيق البحث النصي
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('membership_number', 'like', "%{$search}%")
                    ->orWhere('personal_description', 'like', "%{$search}%")
                    ->orWhere('partner_expectations', 'like', "%{$search}%");
            });
        }

        // تطبيق الفلاتر
        if ($request->has('age_min') && !empty($request->age_min)) {
            $query->where('age', '>=', $request->age_min);
        }
        if ($request->has('age_max') && !empty($request->age_max)) {
            $query->where('age', '<=', $request->age_max);
        }
        if ($request->has('marital_status') && !empty($request->marital_status)) {
            $query->where('marital_status', $request->marital_status);
        }
        if ($request->has('education_level') && !empty($request->education_level)) {
            $query->where('education_level', $request->education_level);
        }
        if ($request->has('monthly_income_min') && !empty($request->monthly_income_min)) {
            $query->where('monthly_income', '>=', $request->monthly_income_min);
        }
        if ($request->has('monthly_income_max') && !empty($request->monthly_income_max)) {
            $query->where('monthly_income', '<=', $request->monthly_income_max);
        }
        if ($request->has('religion') && !empty($request->religion)) {
            $query->where('religion', $request->religion);
        }
        if ($request->has('housing_type') && !empty($request->housing_type)) {
            $query->where('housing_type', $request->housing_type);
        }
        if ($request->has('health_status') && !empty($request->health_status)) {
            $query->where('health_status', $request->health_status);
        }
        if ($request->has('religiosity_level') && !empty($request->religiosity_level)) {
            $query->where('religiosity_level', $request->religiosity_level);
        }
        if ($request->has('prayer_commitment') && !empty($request->prayer_commitment)) {
            $query->where('prayer_commitment', $request->prayer_commitment);
        }
        if ($request->has('has_children') && !empty($request->has_children)) {
            $query->where('has_children', $request->has_children === 'yes' ? 1 : 0);
        }

        $girls = $query->get();

        if (Auth::user()->status !== 'available') {
            return redirect()->route('marriage-requests.status')->with('info', 'لديك طلب خطوبة نشط بالفعل');
        }
        $isProfileComplete = $this->isProfileComplete(Auth::user());

        return view('marriage-requests.girls', compact('girls', 'isProfileComplete'));
    }

    public function index()
    {
        if (!auth()->user()->age || !auth()->user()->gender) {
            session(['previous_url' => route('marriage-requests.index')]);
            return redirect()->route('personal-info');
        }

        $user = Auth::user();
        $marriageRequest = $user->activeMarriageRequest ?? $user->targetMarriageRequest;
        $partner = null;
        $exam = null;
        $totalImportant = null;
        $maleImportantScore = null;
        $femaleImportantScore = null;
        $testResult = null;

        if ($marriageRequest && $marriageRequest->status === 'engaged') {
            $partner = $marriageRequest->user_id === $user->id ? $marriageRequest->target : $marriageRequest->user;
            $exam = $marriageRequest->exam;

            if ($exam && $exam->male_finished && $exam->female_finished) {
                $maleImportantScore = $exam->importantScore('male');
                $femaleImportantScore = $exam->importantScore('female');
                $totalImportant = $maleImportantScore['total'] + $femaleImportantScore['total'];
                $testResult = $exam->calculateScore();
            }
        }
        $isProfileComplete = $this->isProfileComplete(Auth::user());

        return view('marriage-requests.marriage-program', compact(
            'marriageRequest',
            'partner',
            'exam',
            'totalImportant',
            'maleImportantScore',
            'femaleImportantScore',
            'testResult',
            'isProfileComplete'
        ));
    }

    public function show()
    {
        if (!auth()->user()->age || !auth()->user()->gender) {
            session(['previous_url' => route('marriage-requests.index')]);
            return redirect()->route('personal-info');
        }

        $isProfileComplete = $this->isProfileComplete(Auth::user());

        return view('marriage-requests.index', compact('isProfileComplete'));
    }

    public function create()
    {
        return view('marriage-requests.create');
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

        if (Auth::user()->gender === $target->gender) {
            return redirect()->back()->with('error', 'يجب أن يكون الطلب بين جنسين مختلفين');
        }

        if (!$this->isProfileComplete(Auth::user())) {
            return redirect()->route('profile.edit')->with('error', 'يرجى إكمال ملفك الشخصي أولاً قبل تقديم طلب خطوبة');
        }

        return view('marriage-requests.create-proposal', compact('target'));
    }

    public function storeProposal(Request $request, $targetId)
    {
        try {
            $user = Auth::user();
            $target = User::findOrFail($targetId);
            if ($user->status !== 'available' || $target->status !== 'available') {
                return redirect()->back()->with('error', 'لا يمكن تقديم الطلب حالياً');
            }

            if ($user->gender === $target->gender) {
                return redirect()->back()->with('error', 'يجب أن يكون الطلب بين جنسين مختلفين');
            }

            if (MarriageRequest::where('user_id', $user->id)->where('target_user_id', $target->id)->exists()) {
                return redirect()->back()->with('error', 'لديك طلب مسبق لهذا المستخدم');
            }

            if (!$this->isProfileComplete($user)) {
                return redirect()->route('profile.edit')->with('error', 'يرجى إكمال ملفك الشخصي أولاً قبل تقديم طلب خطوبة');
            }

            $marriageRequest = MarriageRequest::create([
                'user_id' => $user->id,
                'target_user_id' => $target->id,
                'request_number' => 'MRQ-' . time(),
                'applicant_type' => $user->gender,
                'status' => 'pending',
                'admin_approval_status' => 'pending',
            ]);

            $exam = Exam::where(function ($query) use ($user, $target) {
                $query->where('male_user_id', $user->gender === 'male' ? $user->id : $target->id)
                    ->where('female_user_id', $user->gender === 'female' ? $user->id : $target->id);
            })->orWhere(function ($query) use ($user, $target) {
                $query->where('male_user_id', $user->gender === 'female' ? $user->id : $target->id)
                    ->where('female_user_id', $user->gender === 'male' ? $user->id : $target->id);
            })->first();

            $testStatus = '';
            $testLink = null;

            if ($exam) {
                $marriageRequest->update(['exam_id' => $exam->id]);
                if ($exam->male_finished && !$exam->female_finished) {
                    $testStatus = $user->gender === 'male' ? 'قمت بإكمال الاختبار، بانتظار الطرف الآخر' : 'الطرف الآخر أكمل الاختبار، يرجى إكماله';
                    $testLink = $user->gender === 'female' ? route('exam.index', ['token' => $exam->token]) : null;
                } elseif (!$exam->male_finished && $exam->female_finished) {
                    $testStatus = $user->gender === 'female' ? 'قمت بإكمال الاختبار، بانتظار الطرف الآخر' : 'الطرف الآخر أكمل الاختبار، يرجى إكماله';
                    $testLink = $user->gender === 'male' ? route('exam.index', ['token' => $exam->token]) : null;
                } elseif ($exam->male_finished && $exam->female_finished) {
                    $testStatus = 'تم إكمال الاختبار من كلا الطرفين';
                }
            } else {
                $testStatus = 'لم يتم إجراء اختبار التوافق بعد';
            }

            $user->update(['status' => 'pending']);
            $target->update(['status' => 'pending']);

            try {
                Mail::to($target->email)->send(new MarriageProposalNotification($user, $target));
            } catch (\Exception $e) {
                \Log::warning('Email sending failed: ' . $e->getMessage());
            }

            return redirect()->route('marriage-requests.status')->with('success', 'تم تقديم الطلب بنجاح')->with([
                'test_status' => $testStatus,
                'test_link' => $testLink,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ تقني، يرجى المحاولة لاحقاً: ' . $e->getMessage())->withInput();
        }
    }

    public function status()
    {
        if (!auth()->user()->age || !auth()->user()->gender) {
            session(['previous_url' => route('marriage-requests.status')]);
            return redirect()->route('personal-info');
        }

        $user = Auth::user();

        $pendingApprovalRequest = MarriageRequest::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('target_user_id', $user->id);
        })
            ->where('status', 'approved')
            ->whereNotNull('exam_id')
            ->whereHas('exam', function ($query) {
                $query->where('male_finished', true)
                    ->where('female_finished', true);
            })
            ->where(function ($query) use ($user) {
                $query->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)
                        ->whereNull('user_approval');
                })
                    ->orWhere(function ($q) use ($user) {
                        $q->where('target_user_id', $user->id)
                            ->whereNull('target_approval');
                    });
            })
            ->first();

        if ($pendingApprovalRequest && (
            ($pendingApprovalRequest->user_id === $user->id && is_null($pendingApprovalRequest->user_approval)) ||
            ($pendingApprovalRequest->target_user_id === $user->id && is_null($pendingApprovalRequest->target_approval))
        )) {
            return redirect()->route('marriage-requests.showResultsAndConfirm', $pendingApprovalRequest->id);
        }

        $pendingRequests = MarriageRequest::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('target_user_id', $user->id);
        })->where('status', 'pending')->get();

        $submittedRequests = $user->submittedRequests;
        $receivedRequests = $user->receivedRequests;

        $marriageRequest = $user->activeMarriageRequest ?? $user->targetMarriageRequest;
        $partner = null;
        $exam = null;
        $totalImportant = null;
        $maleImportantScore = null;
        $femaleImportantScore = null;
        $testResult = null;

        if ($marriageRequest && $marriageRequest->status === 'engaged') {
            $partner = $marriageRequest->user_id === $user->id ? $marriageRequest->target : $marriageRequest->user;
            $exam = $marriageRequest->exam;

            if ($exam && $exam->male_finished && $exam->female_finished) {
                $maleImportantScore = $exam->importantScore('male');
                $femaleImportantScore = $exam->importantScore('female');
                $totalImportant = $maleImportantScore['total'] + $femaleImportantScore['total'];
                $testResult = $exam->calculateScore();
            }
        }

        return view('marriage-requests.status', compact(
            'pendingRequests',
            'submittedRequests',
            'receivedRequests',
            'marriageRequest',
            'partner',
            'totalImportant',
            'maleImportantScore',
            'femaleImportantScore',
            'testResult'
        ));
    }

    public function adminApproval()
    {
        return view('marriage-requests.admin-approval');
    }

    public function approve($id)
    {
        $marriageRequest = MarriageRequest::with(['user', 'target'])->findOrFail($id);

        $marriageRequest->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'تم الموافقة على الطلب وإرسال الإشعارات');
    }

    public function reject($id)
    {
        $request = MarriageRequest::findOrFail($id);
        $request->user->update(['status' => 'available']);
        $request->target->update(['status' => 'available']);
        $request->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'تم رفض الطلب');
    }

    public function respond(Request $request, $id)
    {
        $marriageRequest = MarriageRequest::with('exam')->findOrFail($id);
        $action = $request->input('action');

        if ($action === 'accept') {
            $marriageRequest->update(['status' => 'approved']);

            $exam = Exam::create([
                'male_user_id' => $marriageRequest->user->gender === 'male' ? $marriageRequest->user_id : $marriageRequest->target_user_id,
                'female_user_id' => $marriageRequest->user->gender === 'female' ? $marriageRequest->user_id : $marriageRequest->target_user_id,
                'token' => Str::random(60)
            ]);

            $testLink = route('exam.index', ['token' => $exam->token]);
            $marriageRequest->update([
                'exam_id' => $exam->id,
                'compatibility_test_link' => $testLink,
                'test_link_sent' => true,
            ]);

            try {
                Mail::to($marriageRequest->user->email)->send(
                    new RequestApproved($marriageRequest->user, $marriageRequest->target, $marriageRequest, $exam)
                );

                Mail::to($marriageRequest->target->email)->send(
                    new RequestApproved($marriageRequest->target, $marriageRequest->user, $marriageRequest, $exam)
                );
            } catch (\Exception $e) {
                \Log::error('فشل إرسال البريد: ' . $e->getMessage());
                return redirect()->back()->with('error', 'حدث خطأ أثناء إرسال الإشعارات');
            }
        } elseif ($action === 'reject') {
            $marriageRequest->user->update(['status' => 'available']);
            $marriageRequest->target->update(['status' => 'available']);
            $marriageRequest->update(['status' => 'rejected']);

            try {
                Mail::to($marriageRequest->user->email)->send(
                    new TargetRequestRejected(
                        $marriageRequest->target,
                        $marriageRequest,
                        $request->input('reason')
                    )
                );
            } catch (\Exception $e) {
                \Log::error('فشل إرسال البريد: ' . $e->getMessage());
                return redirect()->back()->with('error', 'حدث خطأ أثناء إرسال الإشعارات');
            }
        }

        return redirect()->back()->with('success', 'تم الرد على الطلب بنجاح');
    }

    public function showResultsAndConfirm($id)
    {
        $marriageRequest = MarriageRequest::with('exam')->findOrFail($id);
        if (!$marriageRequest->exam || !$marriageRequest->exam->male_finished || !$marriageRequest->exam->female_finished) {
            return redirect()->back()->with('error', 'لم يكتمل المقياس بعد');
        }
        $score = $marriageRequest->exam->calculateScore();
        $maleImportantScore = $marriageRequest->exam->importantScore('male');
        $femaleImportantScore = $marriageRequest->exam->importantScore('female');
        $totalImportant = $maleImportantScore['total'] + $femaleImportantScore['total'];
        $otherPartyName = null;
        if ($marriageRequest) {
            $otherPartyName = $marriageRequest->user_id === Auth::user()->id
                ? ($marriageRequest->target->name ?? 'غير محدد')
                : ($marriageRequest->user->name ?? 'غير محدد');
        }
        return view('marriage-requests.confirm', compact('marriageRequest', 'otherPartyName', 'score', 'maleImportantScore', 'femaleImportantScore', 'totalImportant'));
    }

    public function confirm(Request $request, $id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        $user = Auth::user();
        $action = $request->input('action');

        if ($user->id == $marriageRequest->user_id) {
            $marriageRequest->update(['user_approval' => $action == 'accept' ? true : false]);
        } elseif ($user->id == $marriageRequest->target_user_id) {
            $marriageRequest->update(['target_approval' => $action == 'accept' ? true : false]);
        }

        if ($marriageRequest->user_approval && $marriageRequest->target_approval) {
            $marriageRequest->update(['status' => 'awaiting_admin_approval']);
            Mail::to($marriageRequest->user->email)->send(new UserConfirmationNotification($marriageRequest->user, $marriageRequest));
            Mail::to($marriageRequest->target->email)->send(new UserConfirmationNotification($marriageRequest->target, $marriageRequest));
        } elseif ($marriageRequest->user_approval === false || $marriageRequest->target_approval === false) {
            $marriageRequest->update(['status' => 'rejected']);
            $marriageRequest->user->update(['status' => 'available']);
            $marriageRequest->target->update(['status' => 'available']);
            Mail::to($marriageRequest->user->email)->send(new UserRejectedNotification($marriageRequest->user, $marriageRequest));
            Mail::to($marriageRequest->target->email)->send(new UserRejectedNotification($marriageRequest->target, $marriageRequest));
        }

        return redirect()->route('marriage-requests.status')->with('success', 'تم تسجيل ردك بنجاح');
    }

    public function submitTest($id)
    {
        return redirect()->back()->with('success', 'تم تقديم اختبار التوافق بنجاح');
    }

    public function submitTestResult(Request $request, $id)
    {
        $marriageRequest = MarriageRequest::findOrFail($id);
        $marriageRequest->update([
            'compatibility_test_result' => $request->input('result'),
        ]);
        return redirect()->back()->with('success', 'تم تقديم نتيجة الاختبار بنجاح');
    }

    public function finalApproval($id)
    {
        $marriageRequest = MarriageRequest::with('exam')->findOrFail($id);

        $marriageRequest->update(['status' => 'engaged']);
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
                'token' => \Str::random(32),
            ]);
        }

        $testLink = route('exam.index', ['token' => $exam->token]);
        $testResult = $exam->male_finished && $exam->female_finished ? $exam->compatibility_test_result : null;

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
}
