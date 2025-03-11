@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <h1>طلب خطوبة جديد</h1>
    </div>

    <div class="content">
        <h2>مرحبًا فريق الإدارة،</h2>

        <p>تم تقديم طلب خطوبة جديد يحتاج لمراجعتكم:</p>

        <div class="request-info">
            <p><strong>رقم الطلب:</strong> {{ $marriageRequest->request_number }}</p>
            <p><strong>المرسل:</strong> {{ $marriageRequest->user->name }}</p>
            <p><strong>المستهدف:</strong> {{ $marriageRequest->target->name }}</p>
            <p><strong>التاريخ:</strong> {{ $marriageRequest->created_at->format('Y-m-d H:i') }}</p>
        </div>

        <p>يمكنكم مراجعة الطلب من خلال لوحة التحكم الإدارية.</p>

        <div class="actions">
            <a href="{{ route('admin.marriage-requests.index') }}" class="cta-button">
                الانتقال إلى لوحة التحكم
            </a>
        </div>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">موقع زواج المودة</a>. جميع الحقوق محفوظة.</p>
    </div>
</div>
@endsection