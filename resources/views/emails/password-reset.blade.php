@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header" style="text-align:center; padding:20px 0; border-bottom:2px solid #EEE;">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1 style="font-size:2em; color:#2D3748; margin:0;">إعادة تعيين كلمة المرور</h1>
    </div>
    <div class="content" style="padding: 20px;">
        <h2 style="color:#2D3748;">مرحباً {{ $user->name ?? 'المستخدم' }}،</h2>
        <p>لقد استلمنا طلباً لإعادة تعيين كلمة المرور الخاصة بحسابك.</p>
        <p>لإعادة تعيين كلمة المرور، اضغط على الزر التالي:</p>
        <div style="text-align:center; margin: 2rem 0;">
            <a href="{{ $url }}"
                style="display:inline-block; padding:12px 32px; background-color:#d4b341; color:#fff; text-decoration:none; border-radius:8px; font-weight:bold; font-size:1.1em;">إعادة
                تعيين كلمة المرور</a>
        </div>
        <p style="margin-top:24px;">إذا لم تطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذه الرسالة.</p>
    </div>
    <div class="footer" style="margin-top:32px; color:#888; font-size:13px; text-align:center;">
        &copy; {{ date('Y') }} جميع الحقوق محفوظة
    </div>
</div>
@endsection