<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
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
            'name.required'    => 'الاسم المستعار مطلوب',
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

        $user = User::create([
            'name'     => $request->name,
            'gender'   => $request->gender,
            'country'  => $request->country,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        if (session()->has('previous_url')) {
            $redirectUrl = session('previous_url');
            return redirect($redirectUrl);
        }


        return redirect(route('dashboard'));
    }
}
