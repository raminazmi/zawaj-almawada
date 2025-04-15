@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl"
    style="max-width: 600px; margin: 0 auto; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="header" style="text-align: center; padding: 20px 0; border-bottom: 2px solid #eee;">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="height: 80px; margin-bottom: 15px;">
    </div>

    <div class="content" style="padding: 30px 20px; line-height: 1.6;">
        <h2 style="color: #333; margin-bottom: 25px; font-size: 24px;">
            مرحباً {{ $user->name }}،
        </h2>

        <div style="margin-bottom: 30px;">
            <p style="font-size: 16px; color: #555; margin-bottom: 20px;">
                شكراً لتسجيلك في موقع زواج المودة. يرجى استخدام الكود التالي لتفعيل حسابك:
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <span style="display: inline-block; background-color: #f8f9fa; padding: 15px 30px; 
                            border-radius: 8px; border: 2px dashed #d4b341;">
                    <span style="color: #d4b341; margin-left: 8px;">✅</span>
                    <strong style="font-size: 28px; color: #2c3e50; letter-spacing: 3px;">
                        {{ $code }}
                    </strong>
                </span>
            </div>

            <div style="font-size: 15px; color: #777;">
                <span style="margin-left: 5px;">⏰</span>
                صالح لمدة 30 دقيقة فقط
            </div>
        </div>

        <p style="font-size: 14px; color: #888; margin-top: 25px;">
            إذا لم تطلب هذا الكود، يرجى تجاهل هذا البريد.
        </p>
    </div>

    <div class="footer" style="border-top: 2px solid #eee; padding: 20px 0; text-align: center;">
        <p style="color: #999; font-size: 14px; margin-bottom: 15px;">
            مع الشكر،<br>
            فريق زواج المودة
        </p>

        <div style="margin-top: 15px;">
            <a href="https://zawaj-almawada.com"
                style="color: #d4b341; text-decoration: none; margin: 0 10px; font-weight: 500;">
                رابط الموقع
            </a>
            |
            <a href="https://zawaj-almawada.com/contact"
                style="color: #d4b341; text-decoration: none; margin: 0 10px; font-weight: 500;">
                اتصل بنا
            </a>
        </div>

        <p style="color: #999; font-size: 12px; margin-top: 20px;">
            © {{ date('Y') }} زواج المودة. جميع الحقوق محفوظة.
        </p>
    </div>
</div>
@endsection