@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="{{ asset('assets/images/logo.png') }}" alt="شعار الموقع">
        <h1>تمت الموافقة على طلبك</h1>
    </div>

    <div class="content">
        <h2>مرحبًا {{ $user->name }}،</h2>

        <div class="user-info">
            <p><strong>رقم الطلب:</strong> {{ $marriageRequest->request_number }}</p>
            <p><strong>تاريخ الطلب:</strong> {{ $marriageRequest->created_at->format('Y-m-d') }}</p>
        </div>

        <p>تمت الموافقة على طلبك من قبل الإدارة. يمكنك الآن متابعة الخطوات التالية:</p>

        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('marriage-requests.status') }}" class="cta-button">
                عرض تفاصيل الطلب
            </a>
        </div>

        <p>لأي استفسارات، يرجى التواصل مع الدعم الفني عبر
            <a href="mailto:zawajmawadda@gmail.com">zawajmawadda@gmail.com</a>
        </p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} <a href="{{ url('/') }}">موقع زواج المودة</a>. جميع الحقوق محفوظة.</p>
    </div>
</div>
@endsection