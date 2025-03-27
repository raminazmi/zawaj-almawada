@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>طلب زواج جديد يحتاج للمراجعة</h1>
    </div>

    <div class="content">
        <h2>مرحبًا فريق الإدارة،</h2>
        <p>تم تقديم طلب زواج جديد يحتاج إلى مراجعتكم:</p>
        <ul style="list-style: none; padding: 0;">
            <li><strong>من:</strong> {{ $marriageRequest->user->name }}</li>
            <li><strong>إلى:</strong> {{ $marriageRequest->targetUser->name }}</li>
            <li><strong>الرسالة:</strong> {{ $marriageRequest->message }}</li>
        </ul>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('admin.marriage-requests.show', $marriageRequest->id) }}"
                style="display: inline-block; padding: 12px 24px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                عرض تفاصيل الطلب
            </a>
        </div>
        <p>شكرًا لجهودكم،</p>
        <p>فريق زواج المودة</p>
    </div>
</div>
@endsection