@extends('layouts.email')

@section('content')
<div class="email-container" dir="rtl">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>تم رفض ملفك الشخصي</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $user->name }}،</h2>
        <p>نأسف لإعلامك أنه تم رفض ملفك الشخصي من قبل الإدارة.</p>
        <p>يرجى مراجعة المعلومات المقدمة وتحديثها إذا لزم الأمر من خلال الرابط أدناه:</p>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('profile.edit') }}"
                style="display: inline-block; padding: 12px 24px; background-color: #dc3545; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                تعديل ملفي
            </a>
        </div>
        <p>إذا كنت تعتقد أن هذا خطأ، يرجى التواصل مع الدعم الفني عبر <a
                href="mailto:support@zawaj-almawada.com">support@zawaj-almawada.com</a>.</p>
        <p>شكرًا لتفهمك،</p>
        <p>فريق زواج المودة</p>
    </div>
</div>
@endsection