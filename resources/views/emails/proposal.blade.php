@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="/assets/images/logo.png" alt="شعار الموقع">
        <h1>طلب خطوبة جديد</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $target->name }}،</h2>
        <p>لقد تلقيت طلب خطوبة جديد على منصة الزواج الشرعي.</p>

        <div class="user-info">
            <p><strong>اسم المرسل:</strong> {{ $user->name }}</p>
            <p><strong>العمر:</strong> {{ $user->age }}</p>
            <p><strong>المدينة:</strong> {{ $user->city }}</p>
        </div>

        <p>يمكنك الآن تسجيل الدخول إلى حسابك للاطلاع على تفاصيل الطلب والرد عليه:</p>

        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('login') }}" class="cta-button">
                تسجيل الدخول والرد على الطلب
            </a>
        </div>

        <p>إذا واجهتك أي صعوبة، يمكنك التواصل مع فريق الدعم عبر <a
                href="mailto:zawajmawadda@gmail.com">zawajmawadda@gmail.com</a></p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">موقع زواج المودة</a>. جميع الحقوق محفوظة.</p>
    </div>
</div>
@endsection