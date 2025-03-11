@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>طلب خطوبة جديد</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $target->name }}،</h2>
        <p>لقد تلقيت طلب خطوبة جديد على منصة الزواج الشرعي.</p>
        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <p style="margin: 5px 0;"><strong>اسم المرسل:</strong> {{ $user->name }}</p>
            <p style="margin: 5px 0;"><strong>العمر:</strong> {{ $user->age }}</p>
            <p style="margin: 5px 0;"><strong>المدينة:</strong> {{ $user->city }}</p>
        </div>
        <p>يمكنك الآن تسجيل الدخول إلى حسابك للاطلاع على تفاصيل الطلب والرد عليه:</p>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('login') }}"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                تسجيل الدخول والرد على الطلب
            </a>
        </div>
        <p>إذا واجهتك أي صعوبة، يمكنك التواصل مع فريق الدعم عبر <a href="mailto:zawajmawadda@gmail.com"
                style="color: #0071BC; text-decoration: none;">zawajmawadda@gmail.com</a></p>
    </div>
</div>
@endsection