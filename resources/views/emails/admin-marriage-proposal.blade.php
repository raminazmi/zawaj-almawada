@extends('layouts.email')

@section('content')
<div class="email-container">
    <div class="header">
        <img src="https://zawaj-almawada.com/assets/images/logo.png" alt="شعار الموقع"
            style="max-width: 100px; margin-bottom: 10px;">
        <h1>طلب خطوبة جديد</h1>
    </div>

    <div class="content">
        <h2>مرحبًا فريق الإدارة،</h2>
        <p>تم تقديم طلب خطوبة جديد يحتاج لمراجعتكم:</p>
        <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <p style="margin: 5px 0;"><strong>رقم الطلب:</strong> {{ $marriageRequest->request_number }}</p>
            <p style="margin: 5px 0;"><strong>المرسل:</strong> {{ $marriageRequest->user->name }}</p>
            <p style="margin: 5px 0;"><strong>المستهدف:</strong> {{ $marriageRequest->target->name }}</p>
            <p style="margin: 5px 0;"><strong>التاريخ:</strong> {{ $marriageRequest->created_at->format('Y-m-d H:i') }}
            </p>
        </div>
        <p>يمكنكم مراجعة الطلب من خلال لوحة التحكم الإدارية.</p>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('admin.marriage-requests.index') }}"
                style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                الانتقال إلى لوحة التحكم
            </a>
        </div>
    </div>
</div>
@endsection