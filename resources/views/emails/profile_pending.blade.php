@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>ملفك الشخصي في حالة المراجعة</h1>
    </div>

    <div class="content">
        <h2>عزيزي/عزيزتي {{ $user->name }}،</h2>
        <p>تم تحديث ملفك الشخصي بنجاح، وهو الآن في حالة المراجعة من قبل الإدارة.</p>
        <p>سنقوم بإعلامك بمجرد اكتمال عملية المراجعة. يمكنك عرض ملفك الحالي من خلال الرابط أدناه:</p>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('profile-approvals.show', $user->id) }}"
                style="display: inline-block; padding: 12px 24px; background-color: #6b46c1; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                عرض ملفي
            </a>
        </div>
        <p>شكرًا لاستخدامك خدماتنا،</p>
        <p>فريق زواج المودة</p>
    </div>
</div>
@endsection