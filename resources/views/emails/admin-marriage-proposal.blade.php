@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="/assets/images/logo.png" alt="شعار الموقع">
        <h1>طلب خطوبة جديد للمراجعة</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $admin->name }}،</h2>
        <p>تم تقديم طلب خطوبة جديد يحتاج لمراجعتك:</p>

        <div class="user-info">
            <p><strong>رقم الطلب:</strong> {{ $marriageRequest->request_number }}</p>
            <p><strong>المرسل:</strong> {{ $marriageRequest->user->name }}</p>
            <p><strong>المستهدف:</strong> {{ $marriageRequest->target->name }}</p>
            <p><strong>التاريخ:</strong> {{ $marriageRequest->created_at->format('Y-m-d H:i') }}</p>
        </div>

        <div class="actions">
            <a href="{{ route('admin.marriage-requests.approve', $marriageRequest->id) }}"
                class="cta-button bg-green-600 hover:bg-green-700">
                الموافقة على الطلب
            </a>
            <a href="{{ route('admin.marriage-requests.reject', $marriageRequest->id) }}"
                class="cta-button bg-red-600 hover:bg-red-700">
                رفض الطلب
            </a>
        </div>

        <p>يمكنك مراجعة تفاصيل الطلب كاملة من لوحة التحكم:</p>
        <a href="{{ route('admin.dashboard') }}" class="cta-button">
            الانتقال للوحة التحكم
        </a>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">موقع زواج المودة</a>. جميع الحقوق محفوظة.</p>
    </div>
</div>
@endsection