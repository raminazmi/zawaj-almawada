@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>طلب موافقة على ملف شخصي جديد</h1>
    </div>

    <div class="content">
        <h2>مرحبًا فريق الإدارة،</h2>
        <p>تم تقديم ملف شخصي جديد يحتاج إلى مراجعتكم:</p>
        <ul style="list-style: none; padding: 0;">
            <li><strong>اسم المستخدم:</strong> {{ $user->name }}</li>
            <li><strong>البريد الإلكتروني:</strong> {{ $user->email }}</li>
        </ul>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ $approvalLink }}"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 2px 10px;">
                الموافقة على الملف
            </a>
            <a href="{{ $rejectionLink }}"
                style="display: inline-block; padding: 12px 24px; background-color: #dc3545; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 2px 10px;">
                رفض الملف
            </a>
        </div>
        <p>شكرًا لجهودكم،</p>
        <p>فريق زواج المودة</p>
    </div>
</div>
@endsection