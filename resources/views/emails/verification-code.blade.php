@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>تفعيل حسابك في زواج المودة</h1>
    </div>

    <div class="content" style="background-color: #f9f9f9; padding: 20px; border-radius: 10px;">
        <p style="font-size: 16px;">مرحباً {{ $user->name }},</p>
        <p style="font-size: 16px;">شكراً لتسجيلك في موقع زواج المودة. يرجى استخدام الكود التالي لتفعيل حسابك:</p>

        <div style="text-align: center; margin: 25px 0;">
            <div style="display: inline-block; background-color: #d4b341; color: white; 
                        padding: 10px 20px; font-size: 24px; font-weight: bold; 
                        border-radius: 5px; letter-spacing: 5px;">
                {{ $code }}
            </div>
        </div>

        <p style="font-size: 14px; color: #777;">هذا الكود صالح لمدة 30 دقيقة فقط.</p>
        <p style="font-size: 14px; color: #777;">إذا لم تطلب هذا الكود، يرجى تجاهل هذا البريد.</p>
    </div>

    <div class="footer" style="margin-top: 20px; text-align: center; font-size: 12px; color: #999;">
        <p>© {{ date('Y') }} زواج المودة. جميع الحقوق محفوظة.</p>
    </div>
</div>
@endsection