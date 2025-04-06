<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ProfileApprovalNotification;
use App\Mail\ProfilePendingNotification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (Str::contains(url()->previous(), '/exam?token=')) {
            session(['intended_url' => url()->previous()]);
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'gender'   => ['required', 'in:male,female'],
            'country'  => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required'    => 'الاسم مطلوب',
            'name.string'      => 'يجب أن يكون الاسم نصاً',
            'name.max'         => 'يجب ألا يتجاوز الاسم 255 حرفاً',
            'gender.required'  => 'يرجى اختيار الجنس',
            'gender.in'        => 'القيمة المختارة للجنس غير صحيحة. الرجاء اختيار "male" أو "female"',
            'country.required' => 'الدولة مطلوبة',
            'country.string'   => 'يجب أن تكون الدولة نصاً',
            'country.max'      => 'يجب ألا تتجاوز الدولة 255 حرفاً',
            'email.required'   => 'البريد الإلكتروني مطلوب',
            'email.string'     => 'يجب أن يكون البريد الإلكتروني نصاً',
            'email.email'      => 'يجب إدخال بريد إلكتروني صالح',
            'email.max'        => 'يجب ألا يتجاوز البريد الإلكتروني 255 حرفاً',
            'email.unique'     => 'هذا البريد الإلكتروني مستخدم من قبل',
            'phone.string'     => 'يجب أن يكون رقم الهاتف نصاً',
            'phone.max'        => 'يجب ألا يتجاوز رقم الهاتف 20 حرفاً',
            'password.required'   => 'كلمة المرور مطلوبة',
            'password.confirmed'  => 'كلمة المرور غير متطابقة',
            'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل.',
        ]);

        if (!session()->has('previous_url')) {
            $previousUrl = url()->previous();
            if (Str::contains($previousUrl, '/exam?token=')) {
                session(['previous_url' => $previousUrl]);
            }
        }
        do {
            $membershipNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // يولد رقمًا بين 000000 و999999
        } while (User::where('membership_number', $membershipNumber)->exists());

        $user = User::create([
            'name'     => $request->name,
            'gender'   => $request->gender,
            'country'  => $request->country,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'membership_number' => $membershipNumber,
        ]);

        event(new Registered($user));
        Auth::login($user);

        if (session()->has('previous_url')) {
            $redirectUrl = session('previous_url');
            return redirect($redirectUrl);
        }

        return redirect(route('index'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function editProfile()
    {
        if (!auth()->user()->age || !auth()->user()->gender) {
            session(['previous_url' => route('profile.edit')]);
            return redirect()->route('personal-info');
        }
        return view('marriage-requests.form-proposal', ['user' => Auth::user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        try {
            $validated = $request->validate([
                'state' => 'required|string|max:100',
                'tribe' => 'required|string|max:100',
                'lineage' => 'required|in:1,2,3',
                'marital_status' => 'required|in:single,married,widowed,divorced',
                'has_children' => 'required|boolean',
                'children_count' => 'nullable|integer|between:0,20',
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
                'is_smoker' => $user->gender === 'male' ? 'sometimes|boolean' : 'nullable',
                'religiosity_level' => 'required|in:high,medium,low',
                'prayer_commitment' => 'required|in:yes,sometimes,no',
                'personal_description' => 'required|string|max:2000',
                'partner_expectations' => 'required|string|max:2000',
                'full_name' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'legalAgreement' => 'required|accepted',
            ], [
                'state.required' => 'حقل الولاية مطلوب',
                'state.string' => 'يجب أن تكون الولاية نصاً',
                'state.max' => 'يجب ألا تتجاوز الولاية 100 حرف',

                'tribe.required' => 'حقل القبيلة مطلوب',
                'tribe.string' => 'يجب أن تكون القبيلة نصاً',
                'tribe.max' => 'يجب ألا تتجاوز القبيلة 100 حرف',

                'lineage.required' => 'حقل النسب مطلوب',
                'lineage.in' => 'قيمة النسب غير صالحة',

                'marital_status.required' => 'حقل الحالة الاجتماعية مطلوب',
                'marital_status.in' => 'قيمة الحالة الاجتماعية غير صالحة',

                'has_children.required' => 'حقل وجود أطفال مطلوب',
                'has_children.boolean' => 'قيمة وجود أطفال يجب أن تكون نعم أو لا',

                'children_count.integer' => 'عدد الأطفال يجب أن يكون رقماً صحيحاً',
                'children_count.between' => 'عدد الأطفال يجب أن يكون بين 0 و 20',

                'education_level.required' => 'حقل مستوى التعليم مطلوب',
                'education_level.in' => 'قيمة مستوى التعليم غير صالحة',

                'work_sector.required' => 'حقل قطاع العمل مطلوب',
                'work_sector.in' => 'قيمة قطاع العمل غير صالحة',

                'job_title.required' => 'حقل المسمى الوظيفي مطلوب',
                'job_title.string' => 'يجب أن يكون المسمى الوظيفي نصاً',
                'job_title.max' => 'يجب ألا يتجاوز المسمى الوظيفي 255 حرفاً',

                'monthly_income.required' => 'حقل الدخل الشهري مطلوب',
                'monthly_income.numeric' => 'يجب أن يكون الدخل الشهري رقماً',
                'monthly_income.min' => 'يجب أن يكون الدخل الشهري أكبر من أو يساوي صفر',

                'religion.required' => 'حقل الدين مطلوب',
                'religion.string' => 'يجب أن يكون الدين نصاً',
                'religion.max' => 'يجب ألا يتجاوز الدين 255 حرفاً',

                'genetic_diseases.string' => 'يجب أن تكون الأمراض الوراثية نصاً',
                'genetic_diseases.max' => 'يجب ألا تتجاوز الأمراض الوراثية 1000 حرف',

                'infectious_diseases.string' => 'يجب أن تكون الأمراض المعدية نصاً',
                'infectious_diseases.max' => 'يجب ألا تتجاوز الأمراض المعدية 1000 حرف',

                'psychological_disorders.string' => 'يجب أن تكون الاضطرابات النفسية نصاً',
                'psychological_disorders.max' => 'يجب ألا تتجاوز الاضطرابات النفسية 1000 حرف',

                'housing_type.required' => 'حقل نوع السكن مطلوب',
                'housing_type.in' => 'قيمة نوع السكن غير صالحة',

                'health_status.required' => 'حقل الحالة الصحية مطلوب',
                'health_status.string' => 'يجب أن تكون الحالة الصحية نصاً',
                'health_status.max' => 'يجب ألا تتجاوز الحالة الصحية 1000 حرف',

                'has_disability.required' => 'حقل وجود إعاقة مطلوب',
                'has_disability.boolean' => 'قيمة وجود إعاقة يجب أن تكون نعم أو لا',

                'disability_details.string' => 'يجب أن تكون تفاصيل الإعاقة نصاً',
                'disability_details.max' => 'يجب ألا تتجاوز تفاصيل الإعاقة 1000 حرف',

                'has_deformity.required' => 'حقل وجود تشوه مطلوب',
                'has_deformity.boolean' => 'قيمة وجود تشوه يجب أن تكون نعم أو لا',

                'deformity_details.string' => 'يجب أن تكون تفاصيل التشوه نصاً',
                'deformity_details.max' => 'يجب ألا تتجاوز تفاصيل التشوه 1000 حرف',

                'wants_children.required' => 'حقل الرغبة في الإنجاب مطلوب',
                'wants_children.boolean' => 'قيمة الرغبة في الإنجاب يجب أن تكون نعم أو لا',

                'infertility.required' => 'حقل العقم مطلوب',
                'infertility.boolean' => 'قيمة العقم يجب أن تكون نعم أو لا',

                'is_smoker.required' => 'حقل التدخين مطلوب للذكور',
                'is_smoker.boolean' => 'قيمة التدخين يجب أن تكون نعم أو لا',
                'is_smoker.nullable' => 'حقل التدخين غير مسموح للإناث',

                'religiosity_level.required' => 'حقل مستوى التدين مطلوب',
                'religiosity_level.in' => 'قيمة مستوى التدين غير صالحة',

                'prayer_commitment.required' => 'حقل الالتزام بالصلاة مطلوب',
                'prayer_commitment.in' => 'قيمة الالتزام بالصلاة غير صالحة',

                'personal_description.required' => 'حقل الوصف الشخصي مطلوب',
                'personal_description.string' => 'يجب أن يكون الوصف الشخصي نصاً',
                'personal_description.max' => 'يجب ألا يتجاوز الوصف الشخصي 2000 حرف',

                'partner_expectations.required' => 'حقل مواصفات الشريك المطلوب مطلوب',
                'partner_expectations.string' => 'يجب أن تكون مواصفات الشريك المطلوب نصاً',
                'partner_expectations.max' => 'يجب ألا تتجاوز مواصفات الشريك المطلوب 2000 حرف',

                'full_name.required' => 'حقل الاسم كاملا مطلوب',
                'full_name.string' => 'يجب أن يكون الاسم كاملا نصاً',
                'full_name.max' => 'يجب ألا يتجاوز الاسم كاملا 255 حرفاً',

                'village.required' => 'حقل القرية مطلوب',
                'village.string' => 'يجب أن تكون القرية نصاً',
                'village.max' => 'يجب ألا تتجاوز القرية 255 حرفاً',

                'legalAgreement.required' => 'يجب الموافقة على الإقرار القانوني',
                'legalAgreement.accepted' => 'يجب الموافقة على الإقرار القانوني',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('فشل التحقق: ' . json_encode($e->errors()));
            throw $e;
        }

        try {
            $user->update(array_merge($validated, ['profile_status' => 'pending']));
            Mail::to($user->email)->send(new ProfilePendingNotification($user));
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(
                    new ProfileApprovalNotification($user)
                );
            }
        } catch (\Exception $e) {
            Log::error('فشل تحديث الملف الشخصي: ' . $e->getMessage());
            throw $e;
        }

        if ($user->gender === 'male') {
            return redirect()->route('marriage-requests.girls')->with('success', 'تم تحديث الملف الشخصي بنجاح');
        } else {
            return redirect()->route('marriage-requests.boys')->with('success', 'تم تحديث الملف الشخصي بنجاح');
        }
    }
}
