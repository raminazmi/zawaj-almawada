@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>تمت الموافقة على ملفك الشخصي</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $user->name }}،</h2>
        <p>نود إعلامك أنه تمت الموافقة على ملفك الشخصي بنجاح.</p>
        <p>يمكنك الآن الاستفادة من جميع ميزات الموقع والبدء في استقبال طلبات الزواج.</p>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('exam.pledge') }}"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                الانتقال إلى لوحة التحكم
            </a>
        </div>
        <p>شكرًا لانضمامك إلينا!</p>
        <p>فريق زواج المودة</p>
    </div>
</div>
@endsection