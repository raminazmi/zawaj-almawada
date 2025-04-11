<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function notice()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:4']
        ], [
            'code.required' => 'كود التحقق مطلوب',
            'code.digits' => 'يجب أن يتكون كود التحقق من 4 أرقام'
        ]);

        $user = Auth::user();
        $enteredCode = $request->code;

        $verificationCode = VerificationCode::where('user_id', $user->id)
            ->where('code', $enteredCode)
            ->first();

        if (!$verificationCode) {
            return back()->with('error', 'كود التحقق غير صحيح');
        }

        if ($verificationCode->expires_at < now()) {
            return back()->with('error', 'كود التحقق منتهي الصلاحية');
        }

        try {
            $user->email_verified_at = now();
            $user->is_active = true;
            $user->save();

            $verificationCode->delete();

            return redirect()->intended(route('index'))
                ->with('success', 'تم تفعيل حسابك بنجاح!');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التفعيل، يرجى المحاولة لاحقاً.');
        }
    }

    public function resend()
    {
        $user = Auth::user();

        VerificationCode::where('user_id', $user->id)->delete();

        $code = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $verificationCode = VerificationCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => now()->addMinutes(30)
        ]);

        Mail::to($user->email)->send(new VerificationCodeMail($user, $code));

        return back()->with('success', 'تم إرسال كود تحقق جديد إلى بريدك الإلكتروني.');
    }
}
