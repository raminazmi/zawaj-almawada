@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
        <div class="header">
                <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
                        style="max-width: 100px; margin-bottom: 10px;">
                <h1>رابط اختبار المقياس</h1>
        </div>
        <div class="content">
                <h2>مرحبًا {{ $user->name }}،</h2>
                <p>تم إرسال رابط اختبار المقياس من قبل الإدارة لتقييم التوافق بينك وبين خطيبك في طلب الخطوبة رقم
                        <strong>{{ $marriageRequest->request_number }}</strong>.
                </p>
                <p>يرجى الدخول إلى الرابط التالي لإجراء الاختبار:</p>
                <div style="text-align: center; margin: 2rem 0;">
                        <a href="{{ $marriageRequest->compatibility_test_link }}"
                                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                                إجراء اختبار المقياس
                        </a>
                </div>
                <p>شكرًا لاستخدامك زواج المودة!</p>
                <p>فريق زواج المودة</p>
        </div>
</div>
@endsection