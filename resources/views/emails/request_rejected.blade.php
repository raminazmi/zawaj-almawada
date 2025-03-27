@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>تم رفض طلب الخطوبة</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $user->name }}،</h2>
        <p>نأسف لإبلاغك أن طلب الخطوبة رقم <strong>{{ $marriageRequest->request_number }}</strong> قد تم رفضه من قبل
            الإدارة.</p>
        <p><strong>السبب:</strong> {{ $reason }}</p>
        <p>يمكنك مراجعة حالتك أو تقديم طلب جديد عبر لوحة التحكم:</p>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ $dashboardLink }}"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                الانتقال إلى لوحة التحكم
            </a>
        </div>
        <p>شكرًا لاستخدامك زواج المودة!</p>
        <p>فريق زواج المودة</p>
    </div>
</div>
@endsection